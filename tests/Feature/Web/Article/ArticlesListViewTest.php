<?php

declare(strict_types=1);

namespace Tests\Feature\Web\Article;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticlesListViewTest extends TestCase
{
    use RefreshDatabase;

    public function testCanDisplaysTheArticlesIndexPage()
    {
        $response = $this->get(route('articles.page.index'));

        $response->assertStatus(200);

        $response->assertViewIs('articles.index');
    }
}
