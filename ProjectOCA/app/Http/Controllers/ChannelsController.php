<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChannelsController extends Controller
{
    public function index() {

        $user = auth()->user();

        // On récupère les conversations (groupes) de l'utilisateur
        $groups = $user->conversations()->get();

        return view('pages.channels.index', compact('groups'));
    }








}
