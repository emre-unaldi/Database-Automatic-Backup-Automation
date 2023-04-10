<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function index() {
        return view('content.system.home');
    }

    public function login() {
        return view('content.system.login');
    }

    public function register() {
        return view('content.system.register');
    }

    public function forgotPassword() {
        return view('content.system.forgotPassword');
    }

    public function notFound() {
        return view('content.system.notFound');
    }
}
