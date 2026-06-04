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

    // Orbiting service cards — icon + label + tooltip from the block.
    // Backward compatible with the old chip shape (plain string / text-only).
    $chips = collect($data['chips'] ?? [])
        ->map(function ($c) use ($loc) {
            if (! is_array($c)) {
                return ['icon' => 'frunza', 'text' => $c, 'tooltip' => null];
            }

            return [
                'icon'    => $c['icon'] ?? 'frunza',
                'text'    => is_array($c['text'] ?? null) ? ($c['text'][$loc] ?? $c['text']['ro'] ?? null) : ($c['text'] ?? null),
                'tooltip' => is_array($c['tooltip'] ?? null) ? ($c['tooltip'][$loc] ?? $c['tooltip']['ro'] ?? null) : ($c['tooltip'] ?? null),
            ];
        })
        ->filter(fn ($c) => filled($c['text']))
        ->values();
    if ($chips->isEmpty()) {
        $chips = collect([
            ['icon' => 'flacara',   'text' => 'Lemn de foc',             'tooltip' => 'Esente tari (stejar, carpen, fag), livrate acasa.'],
            ['icon' => 'copaci',    'text' => 'Exploatare forestiera',   'tooltip' => 'Prestari servicii in paduri private si de stat.'],
            ['icon' => 'handshake', 'text' => 'Achizitie masa lemnoasa', 'tooltip' => 'Pe picior sau fasonata — evaluare corecta.'],
            ['icon' => 'excavator', 'text' => 'Curatare terenuri',       'tooltip' => 'Defrisare controlata, fara suprafata minima.'],
            ['icon' => 'frunza',    'text' => 'Certificare FSC & PEFC',  'tooltip' => 'Surse responsabile, in proces de certificare.'],
            ['icon' => 'camion',    'text' => 'Livrare locala',          'tooltip' => 'Prahova, Ilfov, Bucuresti · 1-3 zile.'],
        ]);
    }
    $chipCount = max($chips->count(), 1);

    // Lucide-style inline SVGs (white stroke via currentColor on the green disc).
    $iconSvg = function (string $icon, int $size = 22): string {
        $paths = match ($icon) {
            'flacara' => '<path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/>',
            'copaci' => '<path d="M10 10v.2A3 3 0 0 1 8.9 16H5a3 3 0 0 1-1-5.8V10a3 3 0 0 1 6 0Z"/><path d="M7 16v6"/><path d="M13 19v3"/><path d="M12 19h8.3a1 1 0 0 0 .7-1.7L18 14h.3a1 1 0 0 0 .7-1.7L16 9h.2a1 1 0 0 0 .8-1.7L13 3l-1.4 1.5"/>',
            'handshake' => '<path d="m11 17 2 2a1 1 0 1 0 3-3"/><path d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4"/><path d="m21 3 1 11h-2"/><path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3"/><path d="M3 4h8"/>',
            'excavator' => '<path d="M2 22v-5l5-5 5 5-5 5z"/><path d="M9.5 14.5 16 8"/><path d="m17 2 5 5-.5.5a3.53 3.53 0 0 1-5 0 3.53 3.53 0 0 1 0-5L17 2"/>',
            'camion' => '<path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/>',
            default => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>',
        };

        return '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $paths . '</svg>';
    };
@endphp

<section class="banner">
    <img src="{{ asset('images/galle/union.svg') }}" class="brandbg" alt="">

    {{-- WHEEL — desktop: carduri cu eticheta + tooltip; mobil: discuri cu icon, raza redusa (CSS) --}}
    <div class="wheel" aria-hidden="true">
        <div class="rotor">
            <svg viewBox="0 0 760 760" class="absolute inset-0 w-full h-full">
                <circle cx="380" cy="380" r="358" fill="none" stroke="#024846" stroke-opacity="0.18" stroke-width="1.5" stroke-dasharray="2 8"/>
                <circle cx="380" cy="380" r="358" fill="none" stroke="#024846" stroke-opacity="0.12" stroke-width="1"/>
            </svg>
        </div>

        @foreach($chips as $i => $chip)
            <div class="orbit" style="--d: {{ -1 * round(60 / $chipCount * $i, 2) }}s">
                <div class="chip group relative flex items-center gap-3 rounded-full bg-white/15 backdrop-blur-md border border-white/25 shadow-lg shadow-forest/10 p-1 lg:py-2 lg:pl-2 lg:pr-5 whitespace-nowrap">
                    <span class="grid h-12 w-12 shrink-0 place-items-center rounded-full bg-forest text-white">
                        {!! $iconSvg($chip['icon']) !!}
                    </span>
                    <span class="hidden lg:inline text-sm font-medium text-forest">{{ $chip['text'] }}</span>

                    @if($chip['tooltip'])
                        <div class="pointer-events-none hidden lg:block absolute left-1/2 top-full z-20 mt-2 w-max max-w-64 -translate-x-1/2 whitespace-normal rounded-xl bg-white/70 backdrop-blur-md border border-white/40 px-3.5 py-2 text-xs font-medium text-forest shadow-lg opacity-0 transition-opacity duration-200 group-hover:opacity-100">
                            {{ $chip['tooltip'] }}
                        </div>
                    @endif
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
    {{-- pointer-events-none: the container spans the banner and would block hover on the wheel (z-1) --}}
    <div class="pointer-events-none relative z-10 w-[90%] max-w-7xl mx-auto flex flex-col lg:flex-row items-start pt-24">
        <div class="pointer-events-auto max-w-xl pt-6 md:pt-24">
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
