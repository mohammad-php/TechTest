<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Services\ArticleService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Articles
 */
class ArticleController extends Controller
{

    /**
     * Short description here.
     *
     * @var int
     */
    private $perPage = 10;

    /**
     * @param ArticleService $articleService
     */
    public function __construct(
        private readonly ArticleService $articleService
    ) {}


    /**
     * List all articles with pagination.
     *
     * @queryParam page int The page number. Example: 1
     * @queryParam per_page int The number of items per page. Defaults to 10. Example: 5
     *
     * @response {
     * "data": [
     * {
     * "id": 1,
     * "title": "Sample Article",
     * "content": "This is a sample article.",
     * "created_at": "2023-01-01T00:00:00.000000Z",
     * "updated_at": "2023-01-01T00:00:00.000000Z"
     * }
     * ],
     * "links": {
     * "first": "http://your-app-url/api/articles?page=1",
     * "last": "http://your-app-url/api/articles?page=2",
     * "prev": null,
     * "next": "http://your-app-url/api/articles?page=2"
     * },
     * "meta": {
     * "current_page": 1,
     * "from": 1,
     * "last_page": 2,
     * "path": "http://your-app-url/api/articles",
     * "per_page": 5,
     * "to": 5,
     * "total": 10
     * }
     * }
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('per_page', $this->perPage);
        $articles = $this->articleService->getAll((int)$perPage);
        return response()->json($articles);
    }


    /**
     * Store a new article.
     *
     * @bodyParam title string required
     * The title of the article.
     * Example: "New Article"
     *
     * @bodyParam content string required
     * The content of the article.
     * Example: "This is the content of the new article."
     *
     * @bodyParam image file
     * The image file associated with the article.
     * Example: null
     *
     * @response 201 {
     * "id": 2,
     * "title": "New Article",
     * "content": "This is the content of the new article.",
     * "created_at": "2023-01-01T00:00:00.000000Z",
     * "updated_at": "2023-01-01T00:00:00.000000Z"
     * }
     *
     * @param StoreArticleRequest $request
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function store(
        StoreArticleRequest $request
    ): JsonResponse {
        $article = $this->articleService->create($request);
        return response()->json($article, 201);
    }


    /**
     * Show a specific article.
     *
     * Retrieve a specific article by its ID.
     *
     * @urlParam id int required The ID of the article. Example: 1
     *
     * @response 200 {
     * "id": 1,
     * "title": "Sample Article",
     * "content": "This is a sample article.",
     * "created_at": "2023-01-01T00:00:00.000000Z",
     * "updated_at": "2023-01-01T00:00:00.000000Z"
     * }
     *
     * @response 404 {
     * "message": "Record not found."
     * }
     *
     * @param Article $article
     *
     * @return JsonResponse
     */
    public function show(
        Article $article
    ): JsonResponse {
        return response()->json($article);
    }


    /**
     * Update an article.
     *
     * Update the specified article with new data.
     *
     * @urlParam id int required
     * The ID of the article.
     * Example: 1
     *
     * @bodyParam title string
     * The new title of the article.
     * Example: "Updated Article"
     *
     * @bodyParam content string
     * The new content of the article.
     * Example: "This is the updated content."
     *
     * @bodyParam image file
     * The image file associated with the article.
     * Example: null
     *
     * @response 200 {
     * "id": 1,
     * "title": "Updated Article",
     * "content": "This is the updated content.",
     * "created_at": "2023-01-01T00:00:00.000000Z",
     * "updated_at": "2023-01-01T00:00:00.000000Z"
     * }
     * @response 404 {
     * "message": "Record not found."
     * }
     *
     * @param UpdateArticleRequest $request
     * @param Article $article
     *
     * @return JsonResponse
     */
    public function update(
        UpdateArticleRequest $request,
        Article $article
    ): JsonResponse
    {
        $updatedArticle = $this->articleService->update(
            $article,
            $request
        );
        return response()->json($updatedArticle);
    }


    /**
     * Delete an article.
     *
     * Remove the specified article from the database.
     *
     * @urlParam id int required The ID of the article. Example: 1
     * @response 204 {
     * "message": "The article was successfully deleted."
     * }
     * @response 404 {
     * "message": "Record not found."
     * }
     *
     * @param Article $article
     *
     * @return JsonResponse
     */
    public function destroy(Article $article): JsonResponse
    {
        $this->articleService->delete($article);
        return response()->json(null, 204);
    }
}
