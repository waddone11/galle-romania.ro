@php
    $loc = app()->getLocale();
    $t = fn (string $key) => $data[$key][$loc] ?? $data[$key]['ro'] ?? null;

    $eyebrow  = $t('eyebrow') ?? 'Standarde si certificari';
    $titlu    = $t('titlu') ?? 'Calitate certificata, responsabilitate dovedita';
    $subtitlu = $t('subtitlu');

    // Datele vin din modelul Certificare (active, ordonate), nu din block.
    $certificari = \App\Models\Certificare::where('is_active', true)->orderBy('ordine')->get();

    // Track-ul contine 4 copii ale setului: translateX(-50%) = exact 2 seturi,
    // deci bucla e perfect continua si acopera si ecranele late fara goluri.
    $copii = 4;
@endphp

@if($certificari->isNotEmpty())
<section class="bg-mist-warm py-16 lg:py-20 overflow-hidden">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-forest/50">{{ $eyebrow }}</p>
        <h2 class="mt-3 font-display text-4xl lg:text-5xl font-bold text-forest">{{ $titlu }}</h2>
        @if($subtitlu)
            <p class="mt-4 text-base lg:text-lg text-forest-dark/70 max-w-2xl mx-auto">{{ $subtitlu }}</p>
        @endif
    </div>

    <div class="cert-marquee mt-12">
        <div class="cert-marquee-track gap-5 pr-5">
            @for($copie = 0; $copie < $copii; $copie++)
                @foreach($certificari as $cert)
                    @php $inCurs = $cert->status === \App\Enums\CertificareStatus::InProces; @endphp
                    <article
                        @if($copie > 0) aria-hidden="true" @endif
                        class="group/card flex w-48 sm:w-56 shrink-0 flex-col items-center rounded-2xl bg-forest ring-1 ring-forest-dark/40 shadow-sm px-5 py-6 transition hover:bg-forest-dark"
                    >
                        {{-- Zona logo cu inaltime fixa (anti-CLS). Logo-urile sunt variante albe pe fundal inchis. --}}
                        <div class="flex h-14 sm:h-16 w-full items-center justify-center">
                            @if($cert->logo)
                                <img src="{{ asset(ltrim($cert->logo, '/')) }}"
                                     alt="{{ $cert->nume }}"
                                     width="160" height="64"
                                     loading="lazy" decoding="async"
                                     class="h-full w-auto max-w-full object-contain transition {{ $inCurs ? 'opacity-50 group-hover/card:opacity-75' : 'opacity-85 group-hover/card:opacity-100' }}">
                            @endif
                        </div>

                        <p class="mt-4 font-medium text-mist-warm">{{ $cert->nume }}</p>

                        @if($inCurs)
                            <span class="mt-2 inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1 text-xs font-medium text-amber-800 ring-1 ring-amber-200">
                                <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-13a.75.75 0 0 0-1.5 0v5c0 .27.14.52.37.65l3.5 2a.75.75 0 1 0 .76-1.3l-3.13-1.79V5Z" clip-rule="evenodd"/>
                                </svg>
                                {{ __('In curs de obtinere') }}
                            </span>
                        @else
                            <span class="mt-2 inline-flex items-center gap-1.5 rounded-full bg-mint/15 px-3 py-1 text-xs font-medium text-mint ring-1 ring-mint/40">
                                <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.7 5.3a1 1 0 0 1 0 1.4l-7.5 7.5a1 1 0 0 1-1.4 0l-3.5-3.5a1 1 0 1 1 1.4-1.4L8.5 12l6.8-6.7a1 1 0 0 1 1.4 0Z" clip-rule="evenodd"/>
                                </svg>
                                {{ __('Certificat') }}
                            </span>
                            @if($cert->detinator)
                                <span class="mt-1.5 text-xs text-mist/60">{{ __('prin') }} {{ $cert->detinator }}</span>
                            @endif
                        @endif
                    </article>
                @endforeach
            @endfor
        </div>
    </div>
</section>
@endif
