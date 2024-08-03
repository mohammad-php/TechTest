<?php

declare(strict_types=1);

namespace App\Observers;

use App\Enums\MediaCollection;
use App\Models\Article;
use App\Traits\HandlesMediaUploads;
use Exception;

class ArticleUpdateObserver
{

    use HandlesMediaUploads;

    /**
     * Handle the Article "updated" event.
     *
     * @param Article $article
     *
     * @return void
     * @throws Exception
     */
    public function updated(Article $article): void
    {
        $this->handleMediaUpload(
            $article,
            request(),
            MediaCollection::ARTICLE_MAIN_IMAGE->value
        );
    }

}
