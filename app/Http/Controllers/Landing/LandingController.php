<?php

namespace App\Http\Controllers\Landing;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LandingController extends Controller
{
    //
    public function index()
    {
        // Ambil 3 berita terbaru
        $latestArticles = Article::latest()->take(3)->get();

        return view('landing.index', compact('latestArticles'));
    }

    public function listArticles()
    {
        // Ambil semua artikel dengan pagination
        $articles = Article::latest()->paginate(9);

        return view('landing.list-article', compact('articles'));
    }

    public function showArticle($slug)
    {
        // Ambil artikel berdasarkan slug
        $article = Article::where('slug', $slug)->firstOrFail();

        return view('landing.detail-article', compact('article'));
    }
}
