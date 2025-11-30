<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function index()
    {
        // Total berita
        $totalArticles = Article::count();

        // Jumlah admin/users
        $totalAdmins = User::count();

        // Berita hari ini
        $todayArticles = Article::whereDate('created_at', today())->get();
        $todayArticlesCount = $todayArticles->count();

        return view('dashboard.index', compact(
            'totalArticles',
            'totalAdmins',
            'todayArticles',
            'todayArticlesCount'
        ));
    }
}
