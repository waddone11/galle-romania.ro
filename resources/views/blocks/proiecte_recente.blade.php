@php
    $loc = app()->getLocale();
    $prefix = $loc === 'ro' ? '' : '/'.$loc;
    $t = fn (string $key) => $data[$key][$loc] ?? $data[$key]['ro'] ?? null;

    // Datele vin din modelul Proiect (publicate, ordonate), nu din block.
    $proiecte = \App\Models\Proiect::query()
        ->where('is_published', true)
        ->orderBy('ordine')
        ->limit(3)
        ->get();
@endphp

@if($proiecte->isNotEmpty())
<section class="py-16 lg:py-24 px-4 md:px-0">
    <div class="max-w-7xl mx-auto">
        @if($eyebrow = $t('eyebrow'))
            <p class="text-sm uppercase tracking-[0.2em] text-forest/50 text-center">{{ $eyebrow }}</p>
        @endif
        @if($titlu = $t('titlu'))
            <h2 class="mt-3 text-center font-display text-2xl md:text-3xl lg:text-4xl font-bold text-forest text-balance break-words hyphens-auto">{{ $titlu }}</h2>
        @endif

        <div class="mt-12 grid md:grid-cols-3 gap-6">
            @foreach($proiecte as $p)
                @php
                    $cover = $p->coverUrl();
                    $pTitlu = $p->getTranslation('titlu', $loc) ?: $p->getTranslation('titlu', 'ro');
                @endphp
                <a href="{{ $prefix }}/proiecte/{{ $p->slug }}" class="block group">
                    <div class="aspect-video rounded-xl bg-forest/10 mb-3 overflow-hidden @unless($cover) grid place-items-center @endunless">
                        @if($cover)
                            <img src="{{ $cover }}"
                                 alt="{{ $pTitlu }}"
                                 width="800" height="450" loading="lazy" decoding="async"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <svg class="size-10 text-forest/30" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 19.5h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/>
                            </svg>
                        @endif
                    </div>
                    <h3 class="font-display text-lg font-semibold group-hover:text-mint transition-colors">{{ $pTitlu }}</h3>
                    @if($p->locatie || $p->an)
                        <p class="text-sm text-forest-dark/60 mt-1">{{ implode(' · ', array_filter([$p->locatie, $p->an])) }}</p>
                    @endif
                </a>
            @endforeach
        </div>

        <div class="mt-10 text-center">
            <a href="{{ $prefix }}/proiecte" class="inline-flex items-center gap-2 text-forest font-semibold hover:text-mint transition-colors">
                {{ __('Vezi toate proiectele') }}
                <span aria-hidden="true">→</span>
            </a>
        </div>
    </div>
</section>
@endif
