<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function forgetPasswordForm()
    {
        return view('auth.forget-password');
    }

    public function forgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        // Mail::send('email.forget-password', ['token' => $token, function($message) use($request){
        //     $message->to($request->email);

        //     $message->subject('Reset Password');
        // }]);

        Mail::send('email.forget-password', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have emailed your password reset link.');
    }

    public function resetPasswordForm($token)
    {
        return view('auth.forget-password-link', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([

            'email' => 'required|email|exists:users',

            'password' => 'required|string|min:6|confirmed',

            'password_confirmation' => 'required'

        ]);

        $updatePassword = DB::table('password_reset_tokens')

        ->where([

          'email' => $request->email, 

          'token' => $request->token

        ])

        ->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();

        return redirect('/')->with('message', 'Your password has been changed!');

    
    }
}

