<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view('pages.admin.index');
    }

    public function deleteUser(Request $request) {
        // Vérifie si l'utilisateur connecté est admin
        if (!auth()->user() || !auth()->user()->is_admin) {
            abort(403, 'Accès refusé');
        }

        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->firstOrFail();

        if ($user->id === auth()->id()) {
            return back()->withErrors(['email' => 'Vous ne pouvez pas supprimer votre propre compte.']);
        }

        $user->delete();

        return back()->with('success', "Utilisateur supprimé avec succès.");
    }

    public function banUser(Request $request) {
        if (!auth()->user() || !auth()->user()->is_admin) {
            abort(403, 'Accès refusé');
        }

        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->firstOrFail();

        $user->is_banned = true;
        $user->save();

        return back()->with('success', "Utilisateur banni avec succès.");
    }

    public function unbanUser(Request $request) {
        if (!auth()->user() || !auth()->user()->is_admin) {
            abort(403, 'Accès refusé');
        }

        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->firstOrFail();

        $user->is_banned = false;
        $user->save();

        return back()->with('success', "Utilisateur dé-banni avec succès.");
    }


}
