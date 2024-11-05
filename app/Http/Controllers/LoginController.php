<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function login(Request $request)
    {
        // try {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // } catch (\Exception $e) {
        //     dd($e);

        // }

        if (Auth::attempt($credentials)) {
            Auth::user()->tokens()->delete();

            $token = Auth::user()->createToken($request->email)->plainTextToken;

            return ['token' => $token];

        }

        return '';
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
