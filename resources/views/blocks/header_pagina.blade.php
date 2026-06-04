@php
    $loc = app()->getLocale();
    $titlu = $data['titlu'][$loc] ?? $data['titlu']['ro'] ?? null;
    $intro = $data['intro'][$loc] ?? $data['intro']['ro'] ?? null;
@endphp

<section class="bg-forest text-mist-warm py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
        @if($titlu)
            <h1 class="font-display text-4xl md:text-5xl font-semibold">{{ $titlu }}</h1>
        @endif
        @if($intro)
            <p class="mt-4 text-lg text-mist max-w-3xl mx-auto">{{ $intro }}</p>
        @endif
    </div>
</section>
