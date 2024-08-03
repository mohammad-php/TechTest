<?php

declare(strict_types=1);

namespace App\Services;

use App\Jobs\NotifyLambdaOnArticleCreation;
use App\Services\AWS\LambdaInvoker;

class LambdaNotificationService
{
    protected LambdaInvoker $lambdaInvoker;

    public function __construct(LambdaInvoker $lambdaInvoker)
    {
        $this->lambdaInvoker = $lambdaInvoker;
    }

    /**
     * Notify about article creation via AWS Lambda.
     *
     * @param array $articleData
     * @return void
     */
    public function notifyOnArticleCreation(array $articleData): void
    {
        NotifyLambdaOnArticleCreation::dispatch($articleData);
    }
}
