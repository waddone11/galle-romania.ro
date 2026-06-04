<?php

/*
 * Operatiuni de deploy prin rute web (/__ops/*) — pentru hosting FARA SSH.
 *
 * SECURITATE:
 *  - 'enabled' TREBUIE pus pe false (sau routes/deploy.php sters) dupa setup.
 *  - 'secret' se schimba pe server cu un string lung, aleator (nu cel din repo!).
 *  - Fara secret corect sau cu enabled=false, rutele raspund 404 (nu-si dezvaluie existenta).
 */
return [
    'enabled' => env('DEPLOY_OPS_ENABLED', false),
    'secret' => env('DEPLOY_SECRET'),
];
