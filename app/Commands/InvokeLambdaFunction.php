<?php

declare(strict_types=1);

namespace App\Commands;

use App\Contracts\Command;
use App\Enums\LambdaFunction;
use App\Services\AWS\LambdaInvoker;
use Illuminate\Support\Facades\Log;

/**
 * InvokeLambdaFunction AWS Lambda Function
 *
 * @param array $articleData
 * @param LambdaInvoker $lambdaInvoker
 *
 * @return InvokeLambdaFunction
 */
class InvokeLambdaFunction implements Command
{
    /**
     * @param array $articleData
     * @param LambdaInvoker $lambdaInvoker
     */
    public function __construct(
        private readonly array $articleData,
        private readonly LambdaInvoker $lambdaInvoker
    ) {}

    /**
     * Executes Lambda Invoker
     *
     * @return void
     */
    public function execute(): void
    {
        $response = $this->lambdaInvoker
            ->invoke(LambdaFunction::CREATE_ARTICLE_NOTIFY, $this->articleData);
        Log::info('InvokeLambdaFunction response: ', $response);
    }
}
