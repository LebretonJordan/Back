<?php

namespace App\Http\Controllers;

use App\Models\RegistrationModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades;


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

            RegistrationModel::create($data);

            return response()->json();

        } catch (ValidationException $e) {
            return response()->json([
                'error' => $e->errors(),
            ], 422);
        } catch (QueryException $e) {
            return response()->json([
                'error' => __("Database error") . ': ' . $e->getMessage()
            ], 500);
        } catch (Exception $e) {
            logger($e->getMessage());
            return response()->json([
                'error' => __("Internal Server Error")
            ], 500);
        }
    }
}
