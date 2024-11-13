<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    /**
     * Changer le mot de passe de l'utilisateur.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        // Validation des données
        $request->validate([
            'current_password' => 'required|string', // Le mot de passe actuel est requis
            'new_password' => 'required|string|min:8|confirmed', // Nouveau mot de passe requis avec confirmation
        ]);

        // Vérification que le mot de passe actuel correspond à celui de l'utilisateur
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return response()->json(['error' => 'Le mot de passe actuel est incorrect.'], 400);
        }

        // Mise à jour du mot de passe
        Auth::user()->update([
            'password' => Hash::make($request->new_password), // Hachage du nouveau mot de passe
        ]);

        // Retour d'une réponse de succès
        return response()->json(['message' => 'Mot de passe mis à jour avec succès.']);
    }
}
