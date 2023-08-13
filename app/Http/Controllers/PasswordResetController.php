<?php

namespace App\Http\Controllers;

use random;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordResetToken;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;

class PasswordResetController extends Controller
{
    public function passwordReset(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'We cant find a user with that e-mail address.'
            ]);
        }
        $exits = PasswordResetToken::where('email', $request->email)->first();
        if ($exits) {
            $exits->token = Str::random(60);
            $exits->created_at = Carbon::now();
            $exits->save();
        } else {

            $exits = PasswordResetToken::create(
                [
                    'email' => $user->email,
                    'token' => Str::random(60),
                    'created_at' => Carbon::now(),
                ]
            );
        }


        if ($user && $exits)
            $user->notify(
                new PasswordResetRequest($exits->token)
            );

        return response()->json([
            'message' => 'We have e-mailed your password reset link!'
        ]);
    }
    public function emailFind($token)
    {
        $passwordReset = PasswordResetToken::where('token', $token)
            ->first();

        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ]);
        if (Carbon::parse($passwordReset->created_at)->addMinutes(5)->isPast()) {

            $passwordReset->delete();
            return response()->json([
                'message' => 'This password reset token is expired.'
            ]);
        }
        return response()->json(['data'=>$passwordReset,'message' => 'success']);
    }


    public function resetConfirm(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed',
            'token' => 'required|string'
        ]);
        $passwordReset = PasswordResetToken::where([
            ['token', $request->token],
            ['email', $request->email]
        ])->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ]);
        $user = User::where('email', $passwordReset->email)->first();
        if (!$user)
            return response()->json([
                'message' => "We can't find a user with that e-mail address."
            ]);
        $user->password = bcrypt($request->password);
        $user->save();

        $user->notify(new PasswordResetSuccess($passwordReset));
        return response()->json([
            'message' => "success"
        ]);
    }
}
