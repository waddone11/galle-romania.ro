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
        <h2 class="mt-3 font-display text-3xl md:text-4xl lg:text-5xl font-bold text-forest text-balance break-words hyphens-auto">{{ $titlu }}</h2>
        @if($subtitlu)
            <p class="mt-4 text-base lg:text-lg text-forest-dark/70 max-w-2xl mx-auto">{{ $subtitlu }}</p>
        @endif
    </div>

    <div class="cert-marquee mt-12">
        <div class="cert-marquee-track gap-5 pr-5">
            @for($copie = 0; $copie < $copii; $copie++)
                @foreach($certificari as $cert)
                    {{-- Card partajat cu /certificari si /despre (x-certificare-card). --}}
                    <x-certificare-card :cert="$cert" variant="marquee" :aria-hidden="$copie > 0" />
                @endforeach
            @endfor
        </div>
    </div>
</section>
@endif
