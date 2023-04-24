<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUsers() {
        $users = User::get();
        return view('content.users.list')->with('users', $users);
    }

    public function deleteUserById(Request $request) {
        $users = User::find($request->id);
        $users->delete();
        return redirect('/users');
    }

    public function updateUserById(Request $request) {
        $users = User::find($request->u_user_id);
        $users->name = $request->u_name;
        $users->surname = $request->u_surname;
        $users->phone = $request->u_phone;
        $users->email = $request->u_email;
        $users->password = $request->u_password;
        $users->save();
        return redirect('/users');
    }

    public function profile() {
        return view('content.users.profile');
    }

    public function notFound() {
        return view('content.users.notFound');
    }
}