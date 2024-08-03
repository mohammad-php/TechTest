<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Command;

class CommandInvoker
{
    /**
     * @param Command $command
     *
     * @return void
     */
    public function invoke(Command $command): void
    {
        $command->execute();
    }
}
