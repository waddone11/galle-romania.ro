@php
    $loc = app()->getLocale();
    $prefix = $loc === 'ro' ? '' : '/'.$loc;
    $t = fn (string $key) => $data[$key][$loc] ?? $data[$key]['ro'] ?? null;

    $query = \App\Models\Faq::where('is_published', true)->orderBy('ordine');
    if (! empty($data['categorie'])) {
        $query->where('categorie', $data['categorie']);
    }
    // Teaser: limiteaza numarul de intrebari (ex. pe home) + link spre pagina dedicata.
    if (! empty($data['limita'])) {
        $query->limit((int) $data['limita']);
    }
    $faqs = $query->get();

    // Stil "split": jumatate panou forest cu typo mare (in stilul durabilitate_stat,
    // verde pe DREAPTA — in oglinda), jumatate acordeon pe alb. Doar la teaser (home).
    $split = ! empty($data['split']);

    $subtitlu = $t('subtitlu') ?? 'Răspunsuri rapide despre lemn de foc, livrare și servicii.';
@endphp

@if($split)
<section class="grid lg:grid-cols-2 overflow-hidden">
    {{-- Panou verde (dreapta pe desktop, sus pe mobil) — full-bleed, ca durabilitate_stat. --}}
    <div class="bg-forest text-mist px-6 lg:px-16 py-14 lg:py-28 flex items-center lg:order-2">
        <div class="max-w-md">
            <p class="font-display font-extrabold leading-[0.9] tracking-tight text-7xl sm:text-8xl lg:text-[10rem]" aria-hidden="true">
                FAQ<span class="text-mint">?</span>
            </p>
            <h2 class="sr-only">{{ $t('titlu') ?? __('Întrebări frecvente') }}</h2>
            <p class="mt-6 lg:mt-8 text-lg font-light text-mist/75 leading-relaxed">{{ $subtitlu }}</p>
            <a href="{{ $prefix }}/intrebari-frecvente"
               class="mt-8 inline-flex items-center rounded-full bg-mint px-6 py-2.5 text-sm font-semibold text-forest hover:brightness-105 transition">
                {{ __('Vezi toate intrebarile') }}
            </a>
        </div>
    </div>

    {{-- Acordeon pe alb (stanga pe desktop) — acelasi card ca pe /intrebari-frecvente. --}}
    <div class="bg-white px-4 sm:px-6 lg:px-16 py-14 lg:py-24 flex items-center lg:order-1">
        <div class="w-full max-w-2xl mx-auto lg:mx-0 lg:ml-auto space-y-3">
            @include('blocks.partials.faq-card-list', ['faqs' => $faqs, 'loc' => $loc, 'idPrefix' => 'faq-split'])
        </div>
    </div>
</section>
@else
<section class="bg-mist-warm py-16">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        @if($titlu = $t('titlu'))
            <h2 class="font-display text-3xl font-semibold mb-8 text-center">{{ $titlu }}</h2>
        @endif
        {{-- Acelasi stil de card acordeon ca pe /intrebari-frecvente (consecventa). --}}
        <div class="space-y-3">
            @include('blocks.partials.faq-card-list', ['faqs' => $faqs, 'loc' => $loc, 'idPrefix' => 'faq-teaser'])
        </div>
        @if(! empty($data['link_toate']))
            <div class="mt-8 text-center">
                <a href="{{ $prefix }}/intrebari-frecvente"
                   class="inline-flex items-center rounded-full bg-mint px-6 py-2.5 text-sm font-semibold text-forest hover:brightness-105 transition">
                    {{ __('Vezi toate intrebarile') }}
                </a>
            </div>
        @endif
    </div>
</section>
@endif
