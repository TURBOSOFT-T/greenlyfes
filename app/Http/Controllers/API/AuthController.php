<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use App\Models\User;

use App\Mail\VerifyEmail;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\API\BaseController as BaseController;

use Guzzle\Http\Message\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator as ValidationValidator;
use JsonException;
use Illuminate\Support\Facades\Validator;

use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;




class AuthController extends Controller
{

      public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['getuser', 'logout', 'login', 'register']]);
    }

    public $successStatus = 200;


    public function register(Request $request)
    {




        $validator = Validator::make($request->all(), [
            //   'role' => 'required',
            // 'status' => 'required',
            'first_name' => 'required',
            //  'name' => 'required',
            //'phone' => 'required',
            'avatar' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif',
            'email' => 'required|email|unique:users',
            'password' =>  ['required', 'string', 'min:6', 'confirmed'],

        ]);

        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
        }
        if ($request->hasFile('avatar')) {

            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/Image/Users/', $filename);
            $input['avatar'] = $filename;
        }



        $user = User::create([
            'email'         => $request->all()['email'],
            'password'      => Hash::make($request->all()['password']),
        ]);
        if ($user) {
            $verify2 =  DB::table('password_resets')->where([
                ['email', $request->all()['email']]
            ]);

            if ($verify2->exists()) {
                $verify2->delete();
            }
            $pin = rand(100000, 999999);
            DB::table('password_resets')
                ->insert(
                    [
                        'email' => $request->all()['email'],
                        'token' => $pin
                    ]
                );
        }

        Mail::to($request->email)->send(new VerifyEmail($pin));

        $token = $user->createToken('myapptoken')->plainTextToken;

        return new JsonResponse(
            [
                'success' => true,
                'message' => 'Successful created user. Please check your email for a 6-digit pin to verify your email.',
                'token' => $token
            ],
            201
        );
    }


    public function verifyEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['message' => $validator->errors()]);
        }
        $select = DB::table('password_resets')
            ->where('email', Auth::user()->email)
            ->where('token', $request->token);

        if ($select->get()->isEmpty()) {
            return new JsonResponse(['success' => false, 'message' => "Invalid PIN"], 400);
        }

        $select = DB::table('password_resets')
            ->where('email', Auth::user()->email)
            ->where('token', $request->token)
            ->delete();

        $user = User::find(Auth::user()->id);
        $user->email_verified_at = Carbon::now()->getTimestamp();
        $user->save();

        return new JsonResponse(['success' => true, 'message' => "Email is verified"], 200);
    }
    //////////// login ////////////////////


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return new JsonResponse(
                [
                    'success' => false,
                    'message' => $validator->errors()
                ],
                422
            );
        }

        $user = User::where('email', $request->all()['email'])->first();

        // Check Password
        if (!$user || !Hash::check($request->all()['password'], $user->password)) {
            return new JsonResponse(
                [
                    'success' => false,
                    'message' => 'Invalid Credentials'
                ],
                400
            );
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        return new JsonResponse(
            [
                'success' => true,
                'token' => $token,
                'type' => 'Bearer',


                //  'user'=> $user

            ],
            200
        );
    }
    ////// get information about user/////////////
    public function unauthorized()
    {
        return response()->json("unauthorized", 401);
    }

    public function getuser()
    {
      //  $user = Auth::user();

        // return response()->json(['success' => $user], $this->successStatus);
        // return Auth::user();
        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'User fetched successfully!',
            ],
            'data' => [
                'user' => auth()->user(),
            ],
        ]);
    }


    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return new JsonResponse(
            [
                'success' => true,
                'message' => 'Logged Out Successfully'
            ],
            200
        );
    }





    public function resendPin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
        }

        $verify =  DB::table('password_resets')->where([
            ['email', $request->all()['email']]
        ]);

        if ($verify->exists()) {
            $verify->delete();
        }

        $token = random_int(100000, 999999);
        $password_reset = DB::table('password_resets')->insert([
            'email' => $request->all()['email'],
            'token' =>  $token,
            'created_at' => Carbon::now()
        ]);

        if ($password_reset) {
            Mail::to($request->all()['email'])->send(new VerifyEmail($token));

            return new JsonResponse(
                [
                    'success' => true,
                    'message' => "A verification mail has been resent"
                ],
                200
            );
        }
    }




    /////////////// forgot password ///////////////


    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
        }

        $verify = User::where('email', $request->all()['email'])->exists();

        if ($verify) {
            $verify2 =  DB::table('password_resets')->where([
                ['email', $request->all()['email']]
            ]);

            if ($verify2->exists()) {
                $verify2->delete();
            }

            $token = random_int(100000, 999999);
            $password_reset = DB::table('password_resets')->insert([
                'email' => $request->all()['email'],
                'token' =>  $token,
                'created_at' => Carbon::now()
            ]);

            if ($password_reset) {
                Mail::to($request->all()['email'])->send(new ResetPassword($token));

                return new JsonResponse(
                    [
                        'success' => true,
                        'message' => "Please check your email for a 6 digit pin"
                    ],
                    200
                );
            }
        } else {
            return new JsonResponse(
                [
                    'success' => false,
                    'message' => "This email does not exist"
                ],
                400
            );
        }
    }



    /////Verification du code resendPin

    public function verifyPin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'token' => ['required'],
        ]);

        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
        }

        $check = DB::table('password_resets')->where([
            ['email', $request->all()['email']],
            ['token', $request->all()['token']],
        ]);

        if ($check->exists()) {
            $difference = Carbon::now()->diffInSeconds($check->first()->created_at);
            if ($difference > 3600) {
                return new JsonResponse(['success' => false, 'message' => "Token Expired"], 400);
            }

            $delete = DB::table('password_resets')->where([
                ['email', $request->all()['email']],
                ['token', $request->all()['token']],
            ])->delete();

            return new JsonResponse(
                [
                    'success' => true,
                    'message' => "You can now reset your password"
                ],
                200
            );
        } else {
            return new JsonResponse(
                [
                    'success' => false,
                    'message' => "Invalid token"
                ],
                401
            );
        }
    }



    //////////////////Reset password//////////////////////

    public function resetpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => ['required'],
            'password'         => 'required|min:8|max:30',
            'confirm_password' => 'required|same:password'

        ]);

        $passwordReset =     DB::table('password_resets')
            ->where('token', $request->input('token'))
            ->first();
        if (!$passwordReset) {
            return response()->json(['message' => 'Invalid token'], 404);
        }
        $email = DB::table('password_resets')
            ->where('token', $request->input('token'))
            ->value('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->update(['password' => Hash::make($request->input('password'))]);
        DB::table('password_resets')
            ->where('token', $request->input('token'))
            ->delete();



        return new JsonResponse(
            [
                'success' => true,
                'message' => "Password reset",
            ],
            200
        );;
    }








    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password'        => 'required',
            'new_password'         => 'required|min:8|max:30',
            'confirm_password' => 'required|same:new_password'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'validations fails',
                'errors' => $validator->errors()
            ], 422);
        }
        $user = $request->user();

        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);


            return response()->json([
                'message' => ' password successfully updated',
                'errors' => $validator->errors()
            ], 200);
        } else {
            return response()->json([
                'message' => 'old password does not match',
                'errors' => $validator->errors()
            ], 422);
        }
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 90,
            'user' => auth()->user()
        ]);
    }
}