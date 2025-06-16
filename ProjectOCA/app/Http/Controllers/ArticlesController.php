<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index() {
        $articles = Article::orderBy('published_at', 'desc')->get();
        return view('pages.articles.index', compact('articles'));
    }

    public function showArticles($id) {
        $article = Article::findOrFail($id);
        return view($article->view_path, compact('article'));
    }

    public function createArticle(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'view_path' => 'required|string',
        ]);

        $validated['published_at'] = Carbon::now();

        Article::create($validated);

        return redirect()->route('articles.index')->with('success', 'Article créé avec succès.');
    }


}
