<?php

declare(strict_types=1);

namespace App\Contracts;

interface Command
{
    /**
     *
     * @return void
     */
    public function execute(): void;
}
