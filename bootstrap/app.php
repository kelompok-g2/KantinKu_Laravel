<?php

use App\Http\Middleware\EnsureCanteenAdmin;
use App\Http\Middleware\RenderApiErrors;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\SubstituteBindings;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias(['canteen-admin' => EnsureCanteenAdmin::class]);
        $middleware->redirectGuestsTo(fn (Request $request) => $request->is('api', 'api/*') ? null : route('login'));
        $middleware->prependToPriorityList(SubstituteBindings::class, EnsureCanteenAdmin::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->respond(new RenderApiErrors);
        $exceptions->shouldRenderJsonWhen(fn (Request $request) => $request->is('api', 'api/*') || $request->expectsJson());
    })->create();
