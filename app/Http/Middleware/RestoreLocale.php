<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestoreLocale
{
    /**
     * Restaureaza locale-ul din sesiune pentru request-urile care nu trec prin
     * SetLocale (ex. update-urile Livewire, care au endpoint global neprefixat).
     * Pe rutele site, SetLocale ruleaza dupa (middleware de ruta) si suprascrie
     * corect din segmentul de URL.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->hasSession()) {
            $locale = $request->session()->get('locale', config('app.locale', 'ro'));

            if (in_array($locale, ['ro', 'de', 'en'], true)) {
                app()->setLocale($locale);
            }
        }

        return $next($request);
    }
}
