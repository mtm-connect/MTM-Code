<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckSubscription;   // 👈 add this use

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // 👇 register a route alias you can use in routes/web.php
        $middleware->alias([
            'check.subscription' => CheckSubscription::class,
        ]);

        // ❗ Do NOT append globally unless you whitelist account routes inside the middleware,
        // or you'll cause a redirect loop. Using the alias on specific groups is safest.
        // $middleware->web(append: [ CheckSubscription::class ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
