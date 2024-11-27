<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $user = User::where('id', $request->input('id'))->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Utilisateur introuvable'], 404);
        }

        \Log::info('Données reçues : ', $request->all());

        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'society' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone_number' => 'nullable|string|max:255',
        ]);

        \Log::info('Données validées : ', $data);

        $updateData = [];

        if (!empty($data['name'])) {
            $updateData['name'] = $data['name'];
        }
        if (!empty($data['lastname'])) {
            $updateData['lastname'] = $data['lastname'];
        }
        if (!empty($data['society'])) {
            $updateData['society'] = $data['society'];
        }
        if (!empty($data['phone_number'])) {
            $updateData['phone_number'] = $data['phone_number'];
        }
        if (!empty($data['email']) && $data['email'] !== $user->email) {
            $updateData['email'] = $data['email'];
        }

        \Log::info('Données à mettre à jour : ', $updateData);

        if (count($updateData) > 0) {
            $user->update($updateData);
            return response()->json(['success' => true, 'message' => 'Profil mis à jour avec succès']);
        }

        return response()->json(['success' => false, 'message' => 'Aucune donnée à mettre à jour']);
    }

}


