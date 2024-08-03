<?php

declare(strict_types=1);

namespace App\Observers;

use App\Enums\MediaCollection;
use App\Models\Article;
use App\Services\LambdaNotificationService;
use App\Traits\HandlesMediaUploads;
use Exception;

class ArticleCreateObserver
{

    use HandlesMediaUploads;

    /**
     * @param LambdaNotificationService $notificationService
     */
    public function __construct(
        private readonly LambdaNotificationService $notificationService
    ) {}


    /**
     * Handle the Article "created" event.
     *
     * @param Article $article
     *
     * @return void
     * @throws Exception
     */
    public function created(Article $article): void
    {
        $this->handleMediaUpload(
            $article,
            request(),
            MediaCollection::ARTICLE_MAIN_IMAGE->value
        );

        $this->notificationService->notifyOnArticleCreation(
            $article->toArray()
        );
    }
}
