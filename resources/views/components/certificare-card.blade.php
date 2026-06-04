{{--
    Card de certificare reutilizabil — o singura sursa vizuala pentru home (marquee),
    /certificari (detail) si /despre (compact).

    Logo-urile din /images/certificari/ sunt variante albe, deci toate variantele stau
    pe fundal forest. Echivalentul „grayscale → color" pentru logo-urile albe este
    opacitatea: in proces = estompat (50% → 75% la hover), certificat = 85% → 100%.
--}}
@props(['cert', 'variant' => 'marquee', 'ariaHidden' => false])

@php
    $inCurs = $cert->status === \App\Enums\CertificareStatus::InProces;
    $loc = app()->getLocale();
    $descriere = $cert->getTranslation('descriere', $loc) ?: $cert->getTranslation('descriere', 'ro');

    $cardClass = match ($variant) {
        'detail' => 'group/card flex flex-col items-center text-center rounded-2xl bg-forest ring-1 ring-forest-dark/40 shadow-sm px-6 py-8 transition hover:bg-forest-dark',
        'compact' => 'group/card flex flex-col items-center text-center rounded-xl bg-forest ring-1 ring-forest-dark/40 px-3 py-4 transition hover:bg-forest-dark',
        default => 'group/card flex w-48 sm:w-56 shrink-0 flex-col items-center rounded-2xl bg-forest ring-1 ring-forest-dark/40 shadow-sm px-5 py-6 transition hover:bg-forest-dark',
    };

    // Zona logo cu inaltime fixa (anti-CLS).
    $logoZoneClass = match ($variant) {
        'detail' => 'flex h-16 sm:h-20 w-full items-center justify-center',
        'compact' => 'flex h-10 w-full items-center justify-center',
        default => 'flex h-14 sm:h-16 w-full items-center justify-center',
    };

    $numeClass = match ($variant) {
        'detail' => 'mt-5 font-display text-lg font-semibold text-mist-warm',
        'compact' => 'mt-2 text-xs font-medium text-mist-warm',
        default => 'mt-4 font-medium text-mist-warm',
    };

    $pillSize = $variant === 'compact' ? 'px-2.5 py-0.5 text-[11px]' : 'px-3 py-1 text-xs';
@endphp

<article @if($ariaHidden) aria-hidden="true" @endif {{ $attributes->merge(['class' => $cardClass]) }}>
    <div class="{{ $logoZoneClass }}">
        @if($cert->logo)
            <img src="{{ asset(ltrim($cert->logo, '/')) }}"
                 alt="{{ $cert->nume }}"
                 width="160" height="64"
                 loading="lazy" decoding="async"
                 class="h-full w-auto max-w-full object-contain transition {{ $inCurs ? 'opacity-50 group-hover/card:opacity-75' : 'opacity-85 group-hover/card:opacity-100' }}">
        @endif
    </div>

    <p class="{{ $numeClass }}">{{ $cert->nume }}</p>

    @if($inCurs)
        <span class="mt-2 inline-flex items-center gap-1.5 rounded-full bg-amber-50 {{ $pillSize }} font-medium text-amber-800 ring-1 ring-amber-200">
            <svg class="h-3.5 w-3.5 shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-13a.75.75 0 0 0-1.5 0v5c0 .27.14.52.37.65l3.5 2a.75.75 0 1 0 .76-1.3l-3.13-1.79V5Z" clip-rule="evenodd"/>
            </svg>
            {{ __('In curs de obtinere') }}
        </span>
    @else
        <span class="mt-2 inline-flex items-center gap-1.5 rounded-full bg-mint/15 {{ $pillSize }} font-medium text-mint ring-1 ring-mint/40">
            <svg class="h-3.5 w-3.5 shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M16.7 5.3a1 1 0 0 1 0 1.4l-7.5 7.5a1 1 0 0 1-1.4 0l-3.5-3.5a1 1 0 1 1 1.4-1.4L8.5 12l6.8-6.7a1 1 0 0 1 1.4 0Z" clip-rule="evenodd"/>
            </svg>
            {{ __('Certificat') }}
        </span>
        @if($cert->detinator && $variant !== 'compact')
            <span class="mt-1.5 text-xs text-mist/60">{{ __('prin') }} {{ $cert->detinator }}</span>
        @endif
    @endif

    @if($variant === 'detail')
        @if($descriere)
            <p class="mt-4 text-sm leading-relaxed text-mist/75">{{ $descriere }}</p>
        @endif
        @if($cert->emitent)
            <p class="mt-3 text-xs text-mist/50">{{ __('Emis de') }} {{ $cert->emitent }}</p>
        @endif
    @endif
</article>
