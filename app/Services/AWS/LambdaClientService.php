<?php

declare(strict_types=1);

namespace App\Services\AWS;

use Aws\Lambda\LambdaClient;

class LambdaClientService
{
    /**
     * Create and return an instance of LambdaClient.
     *
     * @return LambdaClient
     */
    public function getClient(): LambdaClient
    {
        $lambdaConfig = config('services.aws.lambda');

        return new LambdaClient([
            'region' => $lambdaConfig['region'],
            'version' => $lambdaConfig['version'],
            'credentials' => [
                'key' => $lambdaConfig['credentials']['key'],
                'secret' => $lambdaConfig['credentials']['secret']
            ],
        ]);
    }
}
