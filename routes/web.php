<?php

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use Illuminate\Container\Attributes\DB;
use Illuminate\Container\Attributes\Log;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\ArticleController;
use App\Http\Controllers\Landing\LandingController;
use App\Http\Controllers\Dashboard\DashboardController;

// Landing Page
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Article Routes (Static/Temporary) - Dashboard
    Route::get('/article', [ArticleController::class, 'index'])->name('dashboard.article.index');
    Route::get('/article/create', [ArticleController::class, 'create'])->name('dashboard.article.create');
    Route::get('/article/{id}/edit', [ArticleController::class, 'edit'])->name('dashboard.article.edit');

    Route::post('/article', [ArticleController::class, 'store'])->name('dashboard.article.store');

    Route::put('/article/{id}', [ArticleController::class, 'update'])
        ->name('dashboard.article.update');

    Route::delete('/article/{id}', [ArticleController::class, 'destroy'])
        ->name('dashboard.article.destroy');
});


// Landing Article Routes (Public - must be after dashboard routes to avoid conflict)
Route::get('/articles', [LandingController::class, 'listArticles'])->name('article.list');
Route::get('/article/{slug}', [LandingController::class, 'showArticle'])->name('article.detail');
