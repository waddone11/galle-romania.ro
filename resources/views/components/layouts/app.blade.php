<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Galle Silva — partener local Galle GmbH Germania' }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Standarde germane in Romania: lemn de foc, servicii forestiere, peisagistica si compostare. Galle Silva SRL, partener local Galle GmbH.' }}">

    {{-- Open Graph / social --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Galle Silva">
    <meta property="og:title" content="{{ $title ?? 'Galle Silva — partener local Galle GmbH Germania' }}">
    <meta property="og:description" content="{{ $metaDescription ?? 'Standarde germane in Romania.' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">

    {{-- hreflang for the 3 locales --}}
    @php
        $path = request()->path();
        $segments = explode('/', trim($path, '/'));
        if (! empty($segments) && in_array($segments[0], ['de', 'en'], true)) array_shift($segments);
        $cleanPath = trim(implode('/', $segments), '/');
        $hrefBase = url('/');
    @endphp
    <link rel="alternate" hreflang="ro" href="{{ $hrefBase }}/{{ $cleanPath }}">
    <link rel="alternate" hreflang="de" href="{{ $hrefBase }}/de/{{ $cleanPath }}">
    <link rel="alternate" hreflang="en" href="{{ $hrefBase }}/en/{{ $cleanPath }}">
    <link rel="alternate" hreflang="x-default" href="{{ $hrefBase }}/{{ $cleanPath }}">

    {{-- Organization JSON-LD --}}
    @php
        $orgSettings = class_exists(\App\Settings\GeneralSettings::class) ? app(\App\Settings\GeneralSettings::class) : null;
        $jsonLd = [
            '@context'           => 'https://schema.org',
            '@type'              => 'Organization',
            'name'               => 'Galle Silva',
            'url'                => $hrefBase,
            'email'              => $orgSettings->email ?? 'contact@galle-silva.ro',
            'telephone'          => $orgSettings->telefon ?? null,
            'areaServed'         => ['Prahova', 'Ilfov', 'Bucuresti'],
            'parentOrganization' => [
                '@type' => 'Organization',
                'name'  => 'Galle GmbH',
                'url'   => 'https://www.galle-gmbh.de',
            ],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>

    @stack('seo')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-[#fafaf8] text-forest-dark antialiased">
    <x-site-navbar />

    <main>
        {{ $slot }}
    </main>

    <x-site-footer />

    <x-whatsapp-cta />

    @livewireScripts
</body>
</html>
