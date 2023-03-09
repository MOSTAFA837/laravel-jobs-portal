<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Mail\Websitemail;
use Hash;
use Auth;

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

    // Company Functions
    public function companySignupSubmit(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'person_name' => 'required',
            'username' => 'required|unique:companies',
            'email' => 'required|email||unique:companies',
            'password' => 'required',
            'retype_password' => 'required|same:password',
        ]);

        $token = hash('sha256', time());

        $obj = new Company();
        $obj->company_name = $request->company_name;
        $obj->person_name = $request->person_name;
        $obj->username = $request->username;
        $obj->email = $request->email;
        $obj->password = Hash::make($request->password);
        $obj->token = $token;
        $obj->status = 0;
        $obj->save();

        $verify_link = url('company_signup_verify/' . $token . '/' . $request->email);
        $subject = 'Company Signup Verification';
        $message = 'Please click on the following link: <br>';
        $message .= '<a href="' . $verify_link . '">Click here</a>';

        \Mail::to($request->email)->send(new Websitemail($subject, $message));

        return redirect()
            ->route('login')
            ->with('success', 'An email sent to your email address. You must have to check that and click on the confirmation link to validate your signup.');
    }

    public function companySignupVerify($token, $email)
    {
        $company_data = Company::where('token', $token)
            ->where('email', $email)
            ->first();

        if (!$company_data) {
            return redirect()->route('login');
        }

        $company_data->token = '';
        $company_data->status = 1;
        $company_data->update();

        return redirect()
            ->route('login')
            ->with('success', 'Your email verified successfully. Login to your profile');
    }

    public function forgetPassword()
    {
        return view('front.forget_password_company');
    }
}
