<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class ArticleController extends Controller
{
    /**
     * Article List Web Page
     *
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function index(): Factory|View|Application|\Illuminate\View\View
    {
        return view('articles.index');
    }
}
