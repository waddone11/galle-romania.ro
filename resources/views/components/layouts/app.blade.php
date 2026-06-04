@props([
    'title' => null,
    'metaDescription' => null,
    'canonical' => null,
    'ogImage' => null,
    'ogType' => 'website',
    'noindex' => false,
])
@php
    $settings = class_exists(\App\Settings\GeneralSettings::class) ? app(\App\Settings\GeneralSettings::class) : null;

    $pageTitle = $title ?? 'Galle Silva — partener local Galle GmbH Germania';
    $pageDescription = $metaDescription
        ?? 'Standarde germane in Romania: lemn de foc, servicii forestiere, peisagistica si compostare. Galle Silva SRL, partener local Galle GmbH.';
    $canonicalUrl = $canonical ?? url()->current();
    $ogImageUrl = $ogImage ?? asset('images/galle/forrest_front.jpg');

    // hreflang — strip the locale prefix, rebuild for all three locales.
    $segments = explode('/', trim(request()->path(), '/'));
    if (! empty($segments) && in_array($segments[0], ['de', 'en'], true)) {
        array_shift($segments);
    }
    $cleanPath = trim(implode('/', $segments), '/');
    $hrefBase = rtrim(url('/'), '/');
    $localePath = fn (string $prefix) => $hrefBase.$prefix.($cleanPath !== '' ? '/'.$cleanPath : '');
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#024846">

    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    @if($noindex)
        <meta name="robots" content="noindex, nofollow">
    @endif

    <link rel="canonical" href="{{ $canonicalUrl }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:site_name" content="Galle Silva">
    <meta property="og:locale" content="{{ app()->getLocale() }}_RO">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:image" content="{{ $ogImageUrl }}">

    {{-- Twitter card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta name="twitter:image" content="{{ $ogImageUrl }}">

    {{-- hreflang for the 3 locales --}}
    <link rel="alternate" hreflang="ro" href="{{ $localePath('') }}">
    <link rel="alternate" hreflang="de" href="{{ $localePath('/de') }}">
    <link rel="alternate" hreflang="en" href="{{ $localePath('/en') }}">
    <link rel="alternate" hreflang="x-default" href="{{ $localePath('') }}">

    {{-- Organization + LocalBusiness JSON-LD (NAP din Settings) --}}
    @php
        $localBusiness = [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => 'Galle Silva SRL',
            'url' => $hrefBase,
            'image' => $ogImageUrl,
            'email' => $settings->email ?? 'info@galle-silva.ro',
            'telephone' => $settings->telefon ?? null,
            'priceRange' => 'RON',
            'areaServed' => ['Prahova', 'Ilfov', 'Bucuresti'],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Str. Principala 302',
                'addressLocality' => 'Manesti',
                'addressRegion' => 'Prahova',
                'addressCountry' => 'RO',
            ],
            'parentOrganization' => [
                '@type' => 'Organization',
                'name' => 'Galle GmbH',
                'url' => 'https://www.galle-gmbh.de',
            ],
        ];
    @endphp
    <x-json-ld :data="array_filter($localBusiness, fn ($v) => $v !== null)" />

    @stack('seo')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-[#fafaf8] text-forest-dark antialiased">
    <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:z-[100] focus:top-2 focus:left-2 focus:bg-forest focus:text-mist-warm focus:px-4 focus:py-2 focus:rounded-lg">
        Sari la continut
    </a>

    <x-site-navbar />

    <main id="main" class="-mt-16">
        {{ $slot }}
    </main>

    <x-site-footer />

    <x-whatsapp-cta />
    <x-cookie-consent />

    @livewireScripts
</body>
</html>
