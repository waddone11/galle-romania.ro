<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Galle Silva — partener local Galle GmbH Germania' }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Standarde germane in Romania: lemn de foc, servicii forestiere, peisagistica si compostare. Galle Silva SRL, partener local Galle GmbH.' }}">

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
