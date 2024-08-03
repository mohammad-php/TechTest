<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Traits\HandlesMediaUploads;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ArticleService
{
    use HandlesMediaUploads;

    /**
     *
     * @param int $perPage
     *
     * @return LengthAwarePaginator
     */
    public function getAll(
        int $perPage = 10
    ): LengthAwarePaginator {
        return Article::select(['id', 'title', 'content'])->paginate($perPage);
    }

    /**
     * @throws Exception
     */
    public function create(StoreArticleRequest $request): Article
    {
        try {
            return Article::create($request->validated());
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Failed to create article and upload image.');
        }

    }

    /**
     * Update Article
     *
     * @param Article $article
     * @param UpdateArticleRequest $request
     *
     * @return Article
     */
    public function update(
        Article $article,
        UpdateArticleRequest $request,
    ): Article {
        $article->update($request->validated());
        return $article;
    }

    /**
     * Soft Deletes Article
     *
     * @param Article $article
     *
     * @return void
     */
    public function delete(Article $article): void
    {
        $article->delete();
    }

}
