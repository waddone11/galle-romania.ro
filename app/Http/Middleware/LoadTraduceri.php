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
     * Injecteaza traducerile UI din DB in translatorul Laravel, pentru toate
     * cele 3 locale — SetLocale poate schimba locale-ul ulterior pe rutele
     * site, deci liniile trebuie sa fie disponibile indiferent de locale.
     *
     * Nu folosim Translator::addLines(): acesta sparge cheile pe '.' (Arr::set),
     * deci orice cheie care contine punct (propozitii intregi) nu mai e gasita
     * la lookup-ul JSON exact si cade pe RO. Callback-ul de chei lipsa face
     * potrivire exacta, indiferent de continutul cheii.
     *
     * Cache pe store-ul `database`, invalidat de modelul Traducere la saved/deleted.
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var array<string, array<string, string>> $maps */
        $maps = [];

        foreach (['ro', 'de', 'en'] as $loc) {
            try {
                $maps[$loc] = Cache::rememberForever(
                    "traduceri.$loc",
                    fn (): array => Traducere::all()
                        ->mapWithKeys(fn (Traducere $t): array => [
                            $t->cheie => $t->getTranslation('valoare', $loc) ?: $t->cheie,
                        ])
                        ->all()
                );
            } catch (\Throwable) {
                // Tabela poate lipsi (instalare/migrare in curs) — UI-ul cade pe chei (RO).
                continue;
            }
        }

        if ($maps !== []) {
            app('translator')->handleMissingKeysUsing(
                fn (string $key, array $replace, ?string $locale): ?string => $maps[$locale ?? app()->getLocale()][$key] ?? null
            );
        }

        return $next($request);
    }
}
