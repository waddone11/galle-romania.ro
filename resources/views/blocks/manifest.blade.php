@php
    $loc = app()->getLocale();
    $t = fn (string $key) => $data[$key][$loc] ?? $data[$key]['ro'] ?? null;

    $eyebrow   = $t('eyebrow') ?? 'GALLE SILVA';
    $titluMare = $t('titlu_mare') ?? 'Scoatem padurea din ceata.';
    $tagline   = $t('tagline') ?? 'Limpede, de la padure pana la tine.';
    $intro     = $t('intro');
@endphp

{{-- Manifest: big statement right after the hero — the transition out of the "fog". --}}
<section class="bg-white py-12 lg:py-6 px-6">
    <div class="max-w-5xl mx-auto text-center">
        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-forest">{{ $eyebrow }}</p>

        <h2 class="mt-6 font-display font-extrabold leading-[0.95] text-forest text-6xl sm:text-7xl lg:text-8xl">
            {{ $titluMare }}
        </h2>

        <p class="mt-6 font-display text-2xl sm:text-3xl font-semibold text-mint">
            {{ $tagline }}
        </p>

        @if($intro)
            <p class="mt-8 mx-auto max-w-2xl text-base sm:text-lg font-light text-forest">
                {{ $intro }}
            </p>
        @endif

        {{-- Discreet scroll indicator --}}
        <div class="mt-14 flex justify-center" aria-hidden="true">
            <svg class="size-12 text-forest animate-bounce" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="m6 9 6 6 6-6"/>
            </svg>
        </div>
    </div>
</section>
