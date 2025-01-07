<?php

declare(strict_types=1);

namespace App\Bootstrap;

use Illuminate\Foundation\Configuration\Middleware;

final class MiddlewareBootstrapper
{
    public function __invoke(Middleware $middleware): void
    {
        // ...
    }
}
