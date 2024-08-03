<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Article;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleGetTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Get Article Test
     *
     * @return void
     */
    public function testCanShowAnArticle()
    {
        $article = Article::factory()->create([
            'title' => fake()->sentence(400),
            'content' => fake()->text(400),
        ]);

        $response = $this->getJson(route('articles.show', $article->id));

        $response->assertOk()
            ->assertJsonStructure([
                'id',
                'title',
                'content',
                'created_at',
                'updated_at',
                'image_url'
            ])
            ->assertJsonFragment([
                'title' => $article->title,
                'content' => $article->content,
            ]);
    }

    /**
     * Validate Get Article Test
     *
     * @return void
     */
    public function testReturnsNotFoundForNonExistentArticle()
    {
        $response = $this->getJson(
            route('articles.show',
                fake()->randomNumber()
            ));

        $response->assertNotFound();
    }
}
