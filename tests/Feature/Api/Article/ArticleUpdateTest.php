<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Article;

use App\Enums\MediaCollection;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Tests\TestCase;

class ArticleUpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Update Article Test
     *
     * @return void
     */
    public function testCanUpdateAnArticle()
    {
        $article = Article::factory()->create();

        $updateData = [
            'title' => fake()->sentence(3),
            'content' => fake()->sentence(2),
        ];

        $response = $this->putJson(
            route('articles.update', $article->id),
            $updateData
        );

        $response->assertOk()
            ->assertJsonFragment([
                'title' => $updateData['title'],
                'content' => $updateData['content'],
            ]);

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'title' => $updateData['title'],
            'content' => $updateData['content'],
        ]);
    }

    /**
     * Update Article With Image Test
     *
     * @return void
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function testCanUpdateAnArticleWithImage()
    {
        $article = Article::factory()->create();

        $article->addMedia(UploadedFile::fake()->image('original.jpg'))
            ->toMediaCollection(
                MediaCollection::ARTICLE_MAIN_IMAGE->value
            );

        $updateData = [
            'title' => fake()->sentence(4),
            'content' => fake()->paragraph(2),
            'image' => UploadedFile::fake()->image('updated.jpg'),
        ];

        $response = $this->putJson(route('articles.update', $article->id), $updateData);

        $response->assertOk()
            ->assertJsonFragment([
                'title' => $updateData['title'],
                'content' => $updateData['content'],
            ]);

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'title' => $updateData['title'],
            'content' => $updateData['content'],
        ]);

        $updatedArticle = $article->fresh();
        $this->assertNotNull(
            $updatedArticle->getFirstMediaUrl(
                MediaCollection::ARTICLE_MAIN_IMAGE->value
            ),
            'Image URL should not be null'
        );

        $this->assertStringContainsString(
            'updated.jpg',
            $updatedArticle->getFirstMediaUrl(
                MediaCollection::ARTICLE_MAIN_IMAGE->value
            ),
            'The updated image should be present'
        );
    }

    /**
     * Validate Update Article
     *
     * @return void
     */
    public function testReturnsValidationErrorForTitleExceedingMaxLength()
    {
        $article = Article::factory()->create();

        $updateData = [
            'title' => str_repeat('A', 256),
        ];

        $response = $this->putJson(
            route('articles.update', $article->id),
            $updateData
        );

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['title']);
    }
}
