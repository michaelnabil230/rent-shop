<?php

declare(strict_types=1);

namespace App\Bootstrap;

use Illuminate\Foundation\Configuration\Exceptions;

final class ExceptionBootstrapper
{
    public function __invoke(Exceptions $exceptions): void
    {
        // ...
    }
}
