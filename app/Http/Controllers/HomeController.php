<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('content.home.home');
    }

    public function notFoundPage() {
        return view('content.databases.notFoundPage');
    }
}
