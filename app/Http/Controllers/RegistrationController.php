<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistrationModel;
use Exception;

class RegistrationController extends Controller
{
    public function create(): \Illuminate\View\View
    {
        return view('formulaire');
    }

    public function store(Request $request)
    {
        try {
            // Validation des données
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'society' => 'nullable|string|max:255',
                'email' => 'required|email|max:255|unique:user,email',
                'phone_number' => 'required|string|max:15',
                'password' => 'required|min:8',
                'adress' => 'required|string|max:255',
            ]);

            // Ajouter le rôle "user" par défaut
            $data['role'] = 'user'; // Rôle par défaut

            // Création de l'utilisateur
            $user = RegistrationModel::create($data);

            // Redirection vers la vue "success"
            return redirect()->route('success');

        } catch (Exception $e) {
            // Log de l'erreur
            logger($e->getMessage());

            // Message d'erreur
            session()->flash('error', 'Une erreur est survenue, veuillez réessayer.');

            return view('formulaire'); // Retourne au formulaire en cas d'échec
        }
    }
}
