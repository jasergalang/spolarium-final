<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class VerificationController extends Controller
{
    public function sendVerificationEmail(Request $request)
    {
        // Check if user is authenticated
        if ($request->user()) {
            $user = $request->user();

            // Check if user has verified email
            if ($user->hasVerifiedEmail()) {
                return redirect()->route('home');
            }

            // Send email verification notification
            $user->sendEmailVerificationNotification();

            return back()->with('status', 'Verification email sent!');
        } else {
            // User is not authenticated, handle it accordingly
            return redirect()->route('login')->with('error', 'You need to be logged in to send verification email.');
        }
    }

    public function verify(Request $request)
    {
        $user = User::find($request->route('id'));
        if (!$user) {
            abort(404); // User not found
        }
        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            abort(403);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('home');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->route('login')->with('status', 'Email verified!');
    }
}
