<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Article;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticlesListTest extends TestCase
{
    use RefreshDatabase;

    public function testCanListAllArticles()
    {
        Article::factory()->count(10)->create();

        $this->getJson(route('articles.index', [
                'per_page' => 10
                ]))
            ->assertOk()
            ->assertJsonStructure([
                'current_page',
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'content',
                        'created_at',
                        'updated_at',
                        'deleted_at',
                        'image_url',
                        'media'
                    ]
                ],
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'links' => [
                    '*' => ['url', 'label', 'active']
                ],
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total'
            ]);
    }
}
