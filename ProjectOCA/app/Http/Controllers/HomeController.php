<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index() {
        $articles = Article::orderBy('published_at', 'desc')->take(6)->get();
        return view('pages.home.index', compact('articles'));
    }

    public function setLanguage(Request $request)
    {
        // Liste des langues disponibles (à centraliser si possible)
        $supportedLocales = ['en', 'fr'];

        // Récupère la langue de la requête (par query ou route paramètre)
        $locale = $request->input('lang');

        // Vérifie si la langue est supportée
        if (!in_array($locale, $supportedLocales)) {
            // Facultatif : message flash ou log
            return Redirect::back()->with('error', __('Invalid language selection.'));
        }

        // Enregistre la langue dans la session
        Session::put('locale', $locale);

        // Applique immédiatement la langue (utile si tu fais une redirection avec message flash)
        App::setLocale($locale);

        // Message de confirmation (optionnel)
        return Redirect::back()->with('success', __('Language switched to :lang', ['lang' => strtoupper($locale)]));
    }

}
