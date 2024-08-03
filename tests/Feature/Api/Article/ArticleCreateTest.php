<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Article;

use App\Enums\MediaCollection;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ArticleCreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create Article Test
     *
     * @return void
     */
    public function testCanCreateAnArticle()
    {
        $articleData = Article::factory()->raw();

        $response = $this->postJson(route('articles.store'), $articleData);

        $response->assertCreated()
            ->assertJsonStructure([
                'id',
                'title',
                'content',
                'created_at',
                'updated_at',
                'image_url'
            ]);

        $this->assertDatabaseHas('articles', [
            'title' => $articleData['title'],
            'content' => $articleData['content'],
        ]);
    }

    /**
     * Create Article With Image Test
     *
     * @return void
     */
    public function testCanCreateAnArticleWithImage()
    {
        $articleData = Article::factory()->raw();
        $articleData['image'] = UploadedFile::fake()->image('article.jpg');

        $response = $this->postJson(route('articles.store'), $articleData);

        $response->assertCreated()
            ->assertJsonStructure([
                'id',
                'title',
                'content',
                'created_at',
                'updated_at',
                'image_url'
            ]);

        $this->assertDatabaseHas('articles', [
            'title' => $articleData['title'],
            'content' => $articleData['content'],
        ]);

        $article = Article::first();
        $this->assertNotNull(
            $article->getFirstMediaUrl(
                MediaCollection::ARTICLE_MAIN_IMAGE->value
            ),
            'Image URL should not be null'
        );
    }

    /**
     * Validate Create Article
     *
     * @return void
     */
    public function testReturnsValidationErrorForTitleExceedingMaxLength()
    {
        $articleData = [
            'title' => str_repeat('A', 256),
        ];

        $response = $this->postJson(
            route('articles.store'),
            $articleData
        );

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['title']);
    }
}
