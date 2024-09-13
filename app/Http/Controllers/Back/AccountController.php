<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Rules\MatchOldPassword;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\SendEmailNotification;
use App\Http\Requests\Back\UserRequest;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;

class AccountController  extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user = Auth::user();

        $users =  User::all();
        return view('back.account.account', compact('user', 'users'));
    }


    public function changeStatus($user_id)
    {
        $user = User::find($user_id);

        if ($user) {
            if ($user->status) {
                $user->status = 0;
            } else {
                $user->status = 1;
            }
            $user->save();
        }

        return redirect()->back()
            ->with('success', 'Status updated successfully');
    }



    public function show($id)
    {
        $users = User::find($id);
        return view('back.users.show', compact('users'));
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }


    public function update_avatar()
    {
        $user = Auth::user();

        $users =  User::all();
        return view('back.users.account', compact('user', 'users'));
    }


    public function change_password(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);



        return redirect()->back()
            ->with('success', 'Password updated successfully');
    }

    public function update_address(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|string|max:254',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'address' => 'required|string|max:255',
            // Add other fields as needed
        ]);

        $user->update($request->all());

        return redirect()->back()->with('success', 'Address was updated successfully');
    }

    public function avatar(Request $request)
    {
        $request->validate([

            'image_path' => 'required|image',

        ]);
        $avatarName = time() . '.' . $request->image_path->getClientOriginalExtension();

        $request->image_path->move(public_path('assets/images/'), $avatarName);

        Auth()->user()->update(['image_path' => $avatarName]);

        return back()->with('success', 'Avatar updated successfully.');
    }
}