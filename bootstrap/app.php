<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

/**
 * Carga el autoloader de Composer (OBLIGATORIO)
 */
require_once __DIR__ . '/../vendor/autoload.php';

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // middlewares si necesitas
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
