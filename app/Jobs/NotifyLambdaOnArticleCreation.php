<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Enums\LambdaFunction;
use App\Services\AWS\LambdaInvoker;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NotifyLambdaOnArticleCreation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $articleData;

    /**
     * Create a new job instance.
     *
     * @param array $articleData
     */
    public function __construct(array $articleData)
    {
        $this->articleData = $articleData;
    }

    /**
     * Execute the job.
     *
     * @param LambdaInvoker $lambdaInvoker
     * @return void
     */
    public function handle(
        LambdaInvoker $lambdaInvoker
    ): void {
        try {
            $lambdaInvoker->invoke(
                LambdaFunction::CREATE_ARTICLE_NOTIFY,
                $this->articleData
            );
        } catch (Exception $e) {
            Log::error('Failed to invoke Lambda function: ' . $e->getMessage());
        }
    }
}
