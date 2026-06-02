<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Mecanism simplu pentru cele 3 locale: RO (default, fara prefix), DE (/de), EN (/en).
     * Locale-ul vine din primul segment al URL-ului sau din parametrul de rută `locale`.
     */
    public function handle(Request $request, Closure $next, ?string $locale = null): Response
    {
        $locale = $locale ?? $request->segment(1);

        if (! in_array($locale, ['ro', 'de', 'en'], true)) {
            $locale = config('app.locale', 'ro');
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
