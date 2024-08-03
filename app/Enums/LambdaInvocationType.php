<?php

declare(strict_types=1);

namespace App\Enums;

enum LambdaInvocationType: string
{
    case ASYNC = 'Event';

    case SYNC = 'RequestResponse';

}
