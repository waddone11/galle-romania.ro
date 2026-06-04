<?php

namespace App\Http\Middleware;

use App\Models\Traducere;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class LoadTraduceri
{
    /**
     * Injecteaza traducerile UI din DB in translatorul Laravel (namespace JSON '*'),
     * pentru toate cele 3 locale — SetLocale poate schimba locale-ul ulterior pe
     * rutele site, deci liniile trebuie sa fie disponibile indiferent de locale.
     * Cache pe store-ul `database`, invalidat de modelul Traducere la saved/deleted.
     */
    public function handle(Request $request, Closure $next): Response
    {
        foreach (['ro', 'de', 'en'] as $loc) {
            try {
                $lines = Cache::rememberForever(
                    "traduceri.$loc",
                    fn (): array => Traducere::all()
                        ->mapWithKeys(fn (Traducere $t): array => [
                            "*.{$t->cheie}" => $t->getTranslation('valoare', $loc) ?: $t->cheie,
                        ])
                        ->all()
                );
            } catch (\Throwable) {
                // Tabela poate lipsi (instalare/migrare in curs) — UI-ul cade pe chei (RO).
                continue;
            }

            if ($lines !== []) {
                app('translator')->addLines($lines, $loc, '*');
            }
        }

        return $next($request);
    }
}
