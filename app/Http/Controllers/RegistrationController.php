<?php

namespace App\Http\Controllers;

use App\Models\RegistrationModel;
use Exception;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {

        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'society' => 'nullable|string|max:255',
                'email' => 'required|email|max:255|unique:user,email',
                'phone_number' => 'required|string|max:15',
                'password' => 'required|min:8',
                'adress' => 'required|string|max:255',
            ]);
            $data['role'] = 'user';

            $user = RegistrationModel::create($data);

            return response()->json([ 'code' => 200, 'status' => 'OK' ]);

        } catch (Exception $e) {
            logger($e->getMessage());
            return response()->json([ 'code' => $e->status, 'error' => $e->getMessage() ]);
        }
    }
}
