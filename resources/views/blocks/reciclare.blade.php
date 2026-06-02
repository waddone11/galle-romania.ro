@php
    $loc = app()->getLocale();
    $t = fn (string $key) => $data[$key][$loc] ?? $data[$key]['ro'] ?? null;

    $titlu   = $t('titlu') ?? 'Resursa regenerabila';
    $text    = $t('text') ?? 'Padurea gestionata responsabil se regenereaza: ce recoltam, se replanteaza. Un ciclu sustenabil, certificat FSC si PEFC, care pastreaza resursa vie pentru generatiile urmatoare.';
    $eyebrow = $t('eyebrow') ?? 'Solutii complete pentru lemn si padure';
    $ctaText = $t('cta_text') ?? 'Serviciile noastre';
    $ctaUrl  = $data['cta_url'] ?? '/servicii';
@endphp

<section class="bg-white px-6 py-20 lg:py-28">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-12 gap-12 lg:gap-16 items-center">
        {{-- animated recycle symbol (chasing arrows) --}}
        <div class="lg:col-span-7 order-2 lg:order-1 flex justify-center">
            <svg class="recycle-svg w-full max-w-[420px] h-auto" viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <g class="arrow">
                    <path d="M308.9,215.3 A110,110 0 0 1 173.4,306.7" fill="none" stroke="#28eeaf" stroke-width="24"/>
                    <polygon points="148.2,300.4 178.7,285.4 168.1,328.0" fill="#28eeaf"/>
                </g>
                <g class="arrow" transform="rotate(120 200 200)">
                    <path d="M308.9,215.3 A110,110 0 0 1 173.4,306.7" fill="none" stroke="#28eeaf" stroke-width="24"/>
                    <polygon points="148.2,300.4 178.7,285.4 168.1,328.0" fill="#28eeaf"/>
                </g>
                <g class="arrow" transform="rotate(240 200 200)">
                    <path d="M308.9,215.3 A110,110 0 0 1 173.4,306.7" fill="none" stroke="#28eeaf" stroke-width="24"/>
                    <polygon points="148.2,300.4 178.7,285.4 168.1,328.0" fill="#28eeaf"/>
                </g>
            </svg>
        </div>

        {{-- text --}}
        <div class="lg:col-span-5 order-1 lg:order-2">
            <h2 class="font-display text-4xl lg:text-5xl font-bold text-forest leading-tight">{{ $titlu }}</h2>
            <p class="mt-6 text-lg font-light text-forest/70 leading-relaxed max-w-md">{{ $text }}</p>
            <div class="mt-10">
                <p class="text-sm uppercase tracking-[0.2em] text-forest/50">{{ $eyebrow }}</p>
                <a href="{{ $ctaUrl }}" class="mt-4 inline-flex items-center gap-3 bg-mint px-8 py-4 text-sm font-bold tracking-[0.15em] text-forest hover:brightness-105 transition">
                    {{ Str::upper($ctaText) }}
                    <svg width="20" height="14" viewBox="0 0 20 14" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 7h17M12 1l6 6-6 6"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>
