<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            // return redirect()->intended(RouteServiceProvider::HOME);
            return response()->json(['success' => true], 201);
        }

        $request->user()->sendEmailVerificationNotification();

        // return back()->with('status', 'verification-link-sent');
        return response()->json(['success' => true, 'status' => 'verification-link-sent'], 201);
    }
}
