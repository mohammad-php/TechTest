<?php

declare(strict_types=1);

namespace App\Enums;

enum LambdaFunction: string
{
    case CREATE_ARTICLE_NOTIFY = 'NotifyOnArticleCreation';
}
