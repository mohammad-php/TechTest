<?php

declare(strict_types=1);

namespace App\Services\AWS;

use App\Enums\LambdaFunction;
use App\Enums\LambdaInvocationType;
use Aws\Lambda\LambdaClient;
use Exception;
use Illuminate\Support\Facades\Log;

class LambdaInvoker
{
    /**
     * @var LambdaClient
     */
    protected LambdaClient $client;

    /**
     * @param LambdaClientService $clientService
     */
    public function __construct(LambdaClientService $clientService)
    {
        $this->client = $clientService->getClient();
    }

    /**
     * Invoke the Lambda function.
     *
     * @param LambdaFunction $functionName
     * @param array $payload
     * @param LambdaInvocationType $invocationType
     *
     * @return array|null
     */
    public function invoke(
        LambdaFunction $functionName,
        array $payload,
        LambdaInvocationType $invocationType = LambdaInvocationType::ASYNC
    ): ?array {
        try {
            $result = $this->client->invoke([
                'FunctionName' => $functionName,
                'InvocationType' => $invocationType,
                'Payload' => json_encode($payload),
            ]);

            return json_decode($result->get('Payload')->getContents(), true);
        } catch (Exception $e) {
            Log::error('Error in LambdaInvoker@invoke: ' . $e->getMessage());
            return null;
        }
    }
}
