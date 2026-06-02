@php
    $loc = app()->getLocale();
    $t = fn (string $key) => $data[$key][$loc] ?? $data[$key]['ro'] ?? null;

    $titlu    = $t('titlu') ?? 'Solutia noastra verde';
    $text     = $t('text') ?? 'Tinem cont mereu de mediu, sustenabilitate si responsabilitate cand recoltam si livram. Padure gestionata durabil, certificari FSC si PEFC in lucru, lemn de foc de calitate.';
    $eyebrow  = $t('eyebrow') ?? 'Avem o viziune';
    $ctaText  = $t('cta_text') ?? 'Despre noi';
    $ctaUrl   = $data['cta_url'] ?? '/despre';
@endphp

<section class="bg-white py-20 lg:py-28 px-6">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
        <div>
            <h2 class="font-display text-4xl lg:text-5xl font-bold text-forest leading-tight">{{ $titlu }}</h2>
            <p class="mt-6 text-lg font-light text-forest/70 max-w-md">{{ $text }}</p>
            <div class="mt-10">
                <p class="text-sm uppercase tracking-[0.2em] text-forest/50">{{ $eyebrow }}</p>
                <a href="{{ $ctaUrl }}" class="mt-3 inline-flex items-center rounded-full border-2 border-forest px-7 py-3 text-sm font-semibold tracking-wide text-forest hover:bg-forest hover:text-mist transition">
                    {{ Str::upper($ctaText) }}
                </a>
            </div>
        </div>

        {{-- Line-art dome illustration: drawn on load, clouds drift, birds flap (SMIL) + fly (CSS) --}}
        <div class="eco-svg" aria-hidden="true">
            <svg viewBox="0 0 1080 565" class="w-full h-auto" xmlns="http://www.w3.org/2000/svg">
                <g fill="none" stroke="#024846" stroke-width="2">
                    <path class="grid" style="animation-delay:0s"   d="M199,501 C255,303 430,159 639,159 C848,159 1023,303 1079,501"/>
                    <path class="grid" style="animation-delay:.2s" stroke-width="1.5" opacity="0.8" d="M260,501 C322,340 470,210 639,210 C808,210 956,340 1018,501"/>
                    <path class="grid" style="animation-delay:.35s" stroke-width="1.5" opacity="0.7" d="M330,501 C382,380 500,272 639,272 C778,272 896,380 948,501"/>
                    <path class="grid" style="animation-delay:.5s" stroke-width="1.5" opacity="0.6" d="M410,501 C452,420 540,338 639,338 C738,338 826,420 868,501"/>
                    <path class="grid" style="animation-delay:.65s" stroke-width="1.5" opacity="0.5" d="M500,501 C525,455 580,413 639,413 C698,413 753,455 778,501"/>
                    <path class="grid" style="animation-delay:.3s" stroke-width="1.5" opacity="0.7" d="M639,159 C520,232 360,360 322,501"/>
                    <path class="grid" style="animation-delay:.45s" stroke-width="1.5" opacity="0.7" d="M639,159 C560,250 470,380 470,501"/>
                    <path class="grid" style="animation-delay:.55s" stroke-width="1.5" opacity="0.6" d="M639,159 L639,501"/>
                    <path class="grid" style="animation-delay:.45s" stroke-width="1.5" opacity="0.7" d="M639,159 C720,250 810,380 810,501"/>
                    <path class="grid" style="animation-delay:.3s" stroke-width="1.5" opacity="0.7" d="M639,159 C760,232 920,360 958,501"/>
                </g>

                <line x1="120" y1="501" x2="1060" y2="501" stroke="#28eeaf" stroke-width="2"/>
                <line x1="430" y1="513" x2="510" y2="513" stroke="#28eeaf" stroke-width="2" opacity="0.6"/>
                <line x1="820" y1="513" x2="900" y2="513" stroke="#28eeaf" stroke-width="2" opacity="0.6"/>

                <g transform="translate(470,501)" fill="none" stroke="#28eeaf" stroke-width="6.5" stroke-linejoin="round">
                    <path d="M0,-250 L46,-160 L26,-160 L66,-85 L42,-85 L86,0 L-86,0 L-42,-85 L-66,-85 L-26,-160 L-46,-160 Z"/>
                    <path d="M0,0 L0,46"/>
                </g>
                <g transform="translate(880,501) scale(0.78)" fill="none" stroke="#024846" stroke-width="6" stroke-linejoin="round">
                    <path d="M0,-250 L46,-160 L26,-160 L66,-85 L42,-85 L86,0 L-86,0 L-42,-85 L-66,-85 L-26,-160 L-46,-160 Z"/>
                    <path d="M0,0 L0,46"/>
                </g>

                <g transform="translate(900,118)">
                    <g class="cloud" style="--spd:9s" fill="none" stroke="#024846" stroke-width="6.5">
                        <path d="M0,30 q-26,0 -26,-22 q0,-20 22,-22 q6,-26 38,-22 q18,-22 42,2 q26,-4 26,24 q0,22 -26,22 Z"/>
                    </g>
                </g>
                <g transform="translate(1000,182) scale(0.6)">
                    <g class="cloud" style="--spd:12s" fill="none" stroke="#28eeaf" stroke-width="6.5">
                        <path d="M0,30 q-26,0 -26,-22 q0,-20 22,-22 q6,-26 38,-22 q18,-22 42,2 q26,-4 26,24 q0,22 -26,22 Z"/>
                    </g>
                </g>

                <g class="bird" style="--y:240px; animation-delay:0s">
                    <path fill="none" stroke="#024846" stroke-width="2.5" stroke-linecap="round" d="M0,0 Q9,-9 18,0 Q27,-9 36,0">
                        <animate attributeName="d" dur="0.7s" repeatCount="indefinite"
                            values="M0,0 Q9,-9 18,0 Q27,-9 36,0;M0,0 Q9,3 18,0 Q27,3 36,0;M0,0 Q9,-9 18,0 Q27,-9 36,0"/>
                    </path>
                </g>
                <g class="bird" style="--y:290px; animation-delay:-7s">
                    <path fill="none" stroke="#28eeaf" stroke-width="2.5" stroke-linecap="round" d="M0,0 Q7,-7 14,0 Q21,-7 28,0">
                        <animate attributeName="d" dur="0.6s" repeatCount="indefinite"
                            values="M0,0 Q7,-7 14,0 Q21,-7 28,0;M0,0 Q7,2 14,0 Q21,2 28,0;M0,0 Q7,-7 14,0 Q21,-7 28,0"/>
                    </path>
                </g>
                <g class="bird" style="--y:205px; animation-delay:-12s">
                    <path fill="none" stroke="#024846" stroke-width="2.5" stroke-linecap="round" d="M0,0 Q8,-8 16,0 Q24,-8 32,0">
                        <animate attributeName="d" dur="0.75s" repeatCount="indefinite"
                            values="M0,0 Q8,-8 16,0 Q24,-8 32,0;M0,0 Q8,3 16,0 Q24,3 32,0;M0,0 Q8,-8 16,0 Q24,-8 32,0"/>
                    </path>
                </g>
            </svg>
        </div>
    </div>
</section>
