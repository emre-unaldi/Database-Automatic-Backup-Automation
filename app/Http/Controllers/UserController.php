<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return view('content.user.account');
    }

    public function login() {
        return view('content.user.login');
    }

    public function register() {
        return view('content.user.register');
    }
    
    public function forgotPassword() {
        return view('content.user.forgotPassword');
    }
}
