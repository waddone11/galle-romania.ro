<?php

/*
 * Datele legale ale firmei (publice — registrul comertului), centralizate.
 * Default-urile sunt valorile reale; override posibil din .env (chei comentate
 * in .env.example — NU le lasa goale, env() ar suprascrie default-ul cu '').
 * Dupa modificare pe server: php artisan config:cache.
 *
 * FLAG-uri (vezi README): COMPANY_VAT de confirmat cu contabilul;
 * administrator vs manager general de confirmat la registru.
 */
return [
    'denumire' => env('COMPANY_NAME', 'GALLE SILVA SRL'),
    'forma' => env('COMPANY_FORM', 'SRL'),
    'cui' => env('COMPANY_CUI', '52771440'),
    'tva' => env('COMPANY_VAT', false), // platitor TVA? cand e true, codul fiscal devine RO{cui}
    'reg_com' => env('COMPANY_REGCOM', 'J2025081738000'),
    'euid' => env('COMPANY_EUID', 'ROONRC.J2025081738000'),
    'caen' => env('COMPANY_CAEN', '0220 - Exploatarea forestiera'),
    'data_infiintare' => env('COMPANY_FOUNDED', '2025-10-24'),
    'adresa' => env('COMPANY_ADDRESS', 'Str. Principala nr. 302'),
    'localitate' => env('COMPANY_CITY', 'Sat Manesti, Com. Manesti'),
    'judet' => env('COMPANY_COUNTY', 'Prahova'),
    'cod_postal' => env('COMPANY_ZIP', '107375'),
    'tara' => env('COMPANY_COUNTRY', 'Romania'),
    'administrator' => env('COMPANY_ADMIN', 'Ion Narcis Marin'),
    'telefon' => env('COMPANY_PHONE', '+40 729 961 082'),
    'email' => env('COMPANY_EMAIL', 'info@galle-silva.ro'),
];
