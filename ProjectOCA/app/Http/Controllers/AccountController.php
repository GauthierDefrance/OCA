<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index() {
        return view('pages.account.index');
    }

    public function changeUsername(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|max:24',
        ]);

        $user = auth()->user();
        $user->name = $request->username;
        $user->save();

        return back()->with('success', 'Username updated successfully.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password updated successfully.');
    }

}
