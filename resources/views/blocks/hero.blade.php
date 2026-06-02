@php
    $loc = app()->getLocale();
    $t = fn (string $key) => $data[$key][$loc] ?? $data[$key]['ro'] ?? null;

    $badge      = $t('badge') ?? 'Servicii forestiere si lemn de foc';
    $badgeLink  = $t('badge_link') ?? 'Vezi serviciile';
    $badgeUrl   = $data['badge_url'] ?? '/servicii';
    $titlu      = $t('titlu') ?? 'Padurea, gestionata cu responsabilitate';
    $subtitlu   = $t('subtitlu') ?? 'Recoltare durabila, lemn de foc de calitate si servicii forestiere profesionale in Prahova, Ilfov si Bucuresti.';
    $ctaText    = $t('cta_text') ?? 'Cere oferta';
    $ctaUrl     = $data['cta_url'] ?? '/contact';

    // Orbiting chips — text from the block, evenly spaced around the wheel.
    $chips = collect($data['chips'] ?? [])
        ->map(fn ($c) => is_array($c) ? ($c['text'][$loc] ?? $c['text']['ro'] ?? null) : $c)
        ->filter()
        ->values();
    if ($chips->isEmpty()) {
        $chips = collect([
            'Lemn de foc: stejar, fag, carpen',
            'Servicii forestiere',
            'Certificare FSC & PEFC',
            'Livrare Prahova, Ilfov, Bucuresti',
        ]);
    }
    $chipCount = max($chips->count(), 1);
@endphp

<section class="banner">
    <img src="{{ asset('images/galle/union.svg') }}" class="brandbg" alt="">

    {{-- WHEEL (hidden < 1024px via CSS) --}}
    <div class="wheel" aria-hidden="true">
        <div class="rotor">
            <svg viewBox="0 0 760 760" class="absolute inset-0 w-full h-full">
                <circle cx="380" cy="380" r="358" fill="none" stroke="#024846" stroke-opacity="0.18" stroke-width="1.5" stroke-dasharray="2 8"/>
                <circle cx="380" cy="380" r="358" fill="none" stroke="#024846" stroke-opacity="0.12" stroke-width="1"/>
            </svg>
        </div>

        @foreach($chips as $i => $chip)
            <div class="orbit" style="--d: {{ -1 * round(60 / $chipCount * $i, 2) }}s">
                <div class="chip flex items-center gap-3 rounded-2xl bg-forest/95 backdrop-blur px-4 py-3 shadow-lg shadow-forest/20 whitespace-nowrap">
                    <span class="grid place-items-center h-9 w-9 rounded-full bg-mint/15">
                        <svg width="22" height="14" viewBox="0 0 45 26" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M22.8 6.1C24.9 3.3 28.2 1.5 32 1.5 38.4 1.5 43.5 6.6 43.5 13S38.4 24.5 32 24.5c-3.8 0-7.1-1.8-9.2-4.6-.2.3-.4.6-.6.8C24.5 23.6 28 25.5 32 25.5 38.9 25.5 44.5 19.9 44.5 13S38.9.5 32 .5c-4 0-7.5 1.9-9.8 4.8.2.3.4.5.6.8z" fill="#28eeaf"/><circle cx="13" cy="13" r="12" stroke="#28eeaf"/></svg>
                    </span>
                    <span class="text-mist text-sm font-medium">{{ $chip }}</span>
                </div>
            </div>
        @endforeach
    </div>

    {{-- CLOUDS --}}
    <div class="clouds" aria-hidden="true">
        <img src="{{ asset('images/galle/cloud1.png') }}" style="--i:1" alt="">
        <img src="{{ asset('images/galle/cloud2.png') }}" style="--i:2" alt="">
        <img src="{{ asset('images/galle/cloud3.png') }}" style="--i:3" alt="">
        <img src="{{ asset('images/galle/cloud4.png') }}" style="--i:4" alt="">
        <img src="{{ asset('images/galle/cloud5.png') }}" style="--i:5" alt="">
        <img src="{{ asset('images/galle/cloud5.png') }}" style="--i:1" alt="">
        <img src="{{ asset('images/galle/cloud1.png') }}" style="--i:5" alt="">
        <img src="{{ asset('images/galle/cloud2.png') }}" style="--i:4" alt="">
        <img src="{{ asset('images/galle/cloud3.png') }}" style="--i:3" alt="">
        <img src="{{ asset('images/galle/cloud4.png') }}" style="--i:2" alt="">
        <img src="{{ asset('images/galle/cloud5.png') }}" style="--i:1" alt="">
    </div>

    {{-- INTRO --}}
    <div class="relative z-10 w-[90%] max-w-7xl mx-auto flex items-center">
        <div class="max-w-xl pt-24">
            <a href="{{ $badgeUrl }}" class="pill inline-flex">
                <span class="pill-inner inline-flex items-center gap-3 px-4 py-1.5 text-sm">
                    <span class="text-forest/80">{{ $badge }}</span>
                    <span class="text-forest font-semibold">{{ $badgeLink }} →</span>
                </span>
            </a>

            <h1 class="mt-7 font-display font-extrabold leading-[0.95] text-forest text-5xl sm:text-6xl lg:text-7xl">
                {{ $titlu }}
            </h1>
            <p class="mt-6 text-base sm:text-lg font-light text-forest/70 max-w-md">
                {{ $subtitlu }}
            </p>
            <div class="mt-9">
                <a href="{{ $ctaUrl }}" class="inline-flex rounded-full bg-mint px-8 py-3.5 font-semibold text-forest hover:brightness-105 transition">
                    {{ $ctaText }}
                </a>
            </div>
        </div>
    </div>
</section>
