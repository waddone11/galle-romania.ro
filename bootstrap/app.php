<?php

use App\Http\Middleware\LoadTraduceri;
use App\Http\Middleware\RestoreLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Dupa StartSession (append = la coada grupului web): da update-urilor
        // Livewire locale-ul sesiunii; pe rutele site SetLocale suprascrie apoi.
        $middleware->web(append: [
            RestoreLocale::class,
            LoadTraduceri::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
