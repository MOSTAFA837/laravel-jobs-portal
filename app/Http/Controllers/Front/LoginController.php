<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('front.login');
    }

    public function signup()
    {
        return view('front.signup');
    }

    public function forgetPassword()
    {
        return view('front.forget_password_company');
    }
}
