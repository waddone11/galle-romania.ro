<?php

/*
 * Linkuri social media, configurabile din .env (safe la config:cache).
 * Toate optionale — platformele fara URL nu se randeaza in <x-social-links>.
 * Dupa modificarea valorilor pe server: php artisan config:cache.
 */
return [
    'facebook' => env('SOCIAL_FACEBOOK'),
    'instagram' => env('SOCIAL_INSTAGRAM'),
    'youtube' => env('SOCIAL_YOUTUBE'),
    'tiktok' => env('SOCIAL_TIKTOK'),
    'whatsapp' => env('SOCIAL_WHATSAPP'), // URL complet, ex. https://wa.me/40729961082
    'linkedin' => env('SOCIAL_LINKEDIN'),
];
