<?php

use App\Http\Controllers\Web\ArticleController;
use App\Http\Controllers\Web\FibonacciController;
use Illuminate\Support\Facades\Route;

Route::get(
    'articles', [ArticleController::class, 'index']
)->name('articles.page.index');


Route::prefix('fibonacci')->name('fibonacci.')->group(function () {
    Route::get(
        'basic-recursive/{n}', [FibonacciController::class, 'basicRecursiveFibonacci']
    )->name('basic.recursive');

    Route::get(
        'optimized-memoization/{n}', [FibonacciController::class, 'optimizedMemoizationFibonacci']
    )->name('optimized.memoization');
});
