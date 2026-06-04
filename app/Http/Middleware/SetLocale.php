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

        // Persistat in sesiune ca update-urile Livewire (care nu trec prin acest
        // middleware de ruta) sa primeasca acelasi locale via RestoreLocale.
        if ($request->hasSession()) {
            $request->session()->put('locale', $locale);
        }

        return $next($request);
    }
}
