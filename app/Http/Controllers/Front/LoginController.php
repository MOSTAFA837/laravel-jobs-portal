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

    // Company Auth Functions
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

    public function companyLoginSubmit(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credential = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::guard('company')->attempt($credential)) {
            return redirect()->route('company_dashboard');
        } else {
            return redirect()
                ->route('login')
                ->with('error', 'Informations are not correct!');
        }
    }

    public function companyLogout()
    {
        Auth::guard('company')->logout();

        return redirect()->route('login');
    }

    public function companyForgetPassword()
    {
        return view('front.forget_password_company');
    }

    public function companyForgetPasswordSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $company_data = Company::where('email', $request->email)->first();

        if (!$company_data) {
            return redirect()
                ->back()
                ->with('error', 'Email address not found!');
        }

        $token = hash('sha256', time());

        $company_data->token = $token;
        $company_data->update();

        $reset_link = url('company/reset-password/' . $token . '/' . $request->email);
        $subject = 'Reset Password';
        $message = 'Please click on the following link to reset your password <br>';
        $message .= '<a href="' . $reset_link . '">Reset Password</a>';

        \Mail::to($request->email)->send(new Websitemail($subject, $message));

        return redirect()
            ->route('login')
            ->with('success', 'To reset your password. Please check your email and follow the steps there.');
    }

    public function companyResetPassword($token, $email)
    {
        $company_data = Company::where('token', $token)
            ->where('email', $email)
            ->first();

        if (!$company_data) {
            return redirect()->route('login');
        }

        return view('front.reset_password_company', compact('token', 'email'));
    }

    public function companyResetPasswordSubmit(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'retype_password' => 'required|same:password',
        ]);

        $company_data = Company::where('token', $request->token)
            ->where('email', $request->email)
            ->first();

        $company_data->password = Hash::make($request->password);
        $company_data->token = '';
        $company_data->update();

        return redirect()
            ->route('login')
            ->with('success', 'You have reset your password successfully');
    }
}
