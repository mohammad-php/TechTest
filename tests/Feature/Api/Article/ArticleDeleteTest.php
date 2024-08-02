<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Article;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function testCanDeleteAnArticle()
    {
        $article = Article::factory()->create();

        $response = $this->deleteJson(route(
            'articles.destroy',
            $article->id
            ));

        $response->assertNoContent();

        $this->assertSoftDeleted('articles', ['id' => $article->id]);
    }

    public function testReturnsNotFoundForNonExistentArticleOnDelete()
    {
        $response = $this->deleteJson(route(
            'articles.destroy', fake()->randomNumber()
        ));

        $response->assertNotFound();
    }
}
