<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Media Collections names
 *
 * @param string $collection
 *
 * @return MediaCollection
 */
enum MediaCollection: string
{
    case ARTICLE_MAIN_IMAGE = 'main_image';

}
