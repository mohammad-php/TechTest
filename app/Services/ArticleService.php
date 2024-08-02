<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\MediaCollection;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Traits\HandlesMediaUploads;
use Illuminate\Pagination\LengthAwarePaginator;

class ArticleService
{
    use HandlesMediaUploads;

    public function getAll(int $perPage = 10): LengthAwarePaginator
    {
        return Article::paginate($perPage);
    }

    public function create(StoreArticleRequest $request): Article
    {
        $article = Article::create($request->validated());

        if(!empty($article)) {
            $this->handleMediaUpload(
                $article,
                $request,
                MediaCollection::ARTICLE_MAIN_IMAGE->value
            );
        }
        return $article;
    }

    public function update(
        Article $article,
        UpdateArticleRequest $request,
    ): Article {
        $article->update($request->validated());

        $this->handleMediaUpload(
            $article,
            $request,
            MediaCollection::ARTICLE_MAIN_IMAGE->value
        );

        return $article;
    }

    public function delete(Article $article): void
    {
        $article->delete();
    }

}
