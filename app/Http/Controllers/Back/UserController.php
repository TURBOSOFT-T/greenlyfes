<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Back\UserRequest;
use App\Http\Requests\MessagePost;
use App\Notifications\PostMessage;

use App\Notifications\SendEmailNotification;

use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;

use App\Repositories\ { PostRepository, MessageRepository };

class UserController extends ResourceController
{
    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Back\UserRequest  $request
     * @param  integer $id
     * @return \Illuminate\Http\Response
    */
    public function update($id)
    {
        $request = app()->make(UserRequest::class);

        $request->merge([
            'valid' => $request->has('valid'),
        ]);

        User::findOrFail($id)->update($request->all());

        return back()->with('ok', __('The user has been successfully updated'));
    }

    /**
     * Valid the user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function valid(User $user)
    {
        $user->valid = true;
        $user->save();

        return response()->json();
    }

    /**
     * Unvalid the user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function unvalid(User $user)
    {
        $user->valid = false;
        $user->save();

        return response()->json();
    }

    
// send Email
public function emailView($id) {
    $data = User::find($id);
    return view('back.users.send_email_view', compact('data'));
}
 // send email to each users

public function storeSingleEmail(Request $request, $id)
{

    $user = User::find($id);
    $details = array();

    $details['greeting'] = $request->greeting;
    $details['body'] = $request->body;
    $details['actiontext'] = $request->actiontext;
    $details['actionurl'] = $request->actionurl;
    $details['endtext'] = $request->endtext;

    Notification::send($user, new SendEmailNotification($details));


   return back()->with('ok', __('The aim has been successfully sent'));
}


public function emailViewAll()
{
    return view('back.users.send_email_all');
}

public function storeAllUserEmail(Request $request)
{

    $users = User::all();
    $details = array();
    $details['greeting'] = $request->greeting;
    $details['body'] = $request->body;
    $details['actiontext'] = $request->actiontext;
    $details['actionurl'] = $request->actionurl;
    $details['endtext'] = $request->endtext;

    foreach($users as $user) {
        Notification::send($user, new SendEmailNotification($details));
    }

   return back('back.shared.index')->with('ok', __('The mail has been successfully sent'));
}


public function update_avatar()
{
    $user = Auth::user();

    $users =  User::all();
    return view('back.account.account', compact('user', 'users'));
}

public function list(Request $request)
{
    $data = User::orderBy('id', 'DESC')->paginate(5);
    return view('users.index', compact('data'))
    ->with('i', ($request->input('page', 1) - 1) * 5);
}



}
