<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

/**
 * Gardian pentru rutele de deploy /__ops/* (hosting fara SSH).
 *
 * Raspunde 404 (nu 403) cand operatiunile sunt dezactivate sau secretul e gresit,
 * ca sa nu dezvaluie existenta endpoint-urilor. Fiecare apel e logat cu IP.
 */
class DeployOpsGate
{
    public function handle(Request $request, Closure $next): Response
    {
        $secret = (string) config('deploy.secret');

        $permis = (bool) config('deploy.enabled')
            && $secret !== ''
            && hash_equals($secret, (string) $request->query('secret'));

        Log::warning('deploy-ops: apel '.($permis ? 'ACCEPTAT' : 'RESPINS'), [
            'path' => $request->path(),
            'ip' => $request->ip(),
        ]);

        abort_unless($permis, 404);

        return $next($request);
    }
}
