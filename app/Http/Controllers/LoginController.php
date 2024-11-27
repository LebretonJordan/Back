<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

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
        try {

            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',

            ]);
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
            $user = auth()->user();
            $token = JWTAuth::claims([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'lastname' => $user->lastname,
                'phone_number' => $user->phone_number,
                'society' => $user->society,

            ])->fromUser($user);
            return response()->json(compact('token'));
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
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
