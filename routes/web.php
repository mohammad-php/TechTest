<?php

use App\Http\Controllers\Web\ArticleController;
use Illuminate\Support\Facades\Route;

Route::get(
    'articles', [ArticleController::class, 'index']
)->name('articles.page.index');
