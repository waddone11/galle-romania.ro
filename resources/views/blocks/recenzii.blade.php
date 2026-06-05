@php
    $loc = app()->getLocale();
    $t = fn (string $key) => $data[$key][$loc] ?? $data[$key]['ro'] ?? null;

    // Doar recenzii reale, publicate explicit din admin (fara seed, fara placeholder).
    $query = \App\Models\Recenzie::where('is_published', true)
        ->orderBy('ordine')
        ->orderByDesc('data');
    if (! empty($data['serviciu'])) {
        $query->where('serviciu', $data['serviciu']);
    }
    if (! empty($data['limita'])) {
        $query->limit((int) $data['limita']);
    }
    $recenzii = $query->get();

    $eyebrow = $t('eyebrow');
    $titlu = $t('titlu') ?? 'Ce spun clienții';

    // JSON-LD: Review per recenzie reala; AggregateRating DOAR daca exista
    // cel putin 3 recenzii publicate cu rating — nu inventam medii/numere.
    $schema = null;
    if ($recenzii->isNotEmpty()) {
        $rated = $recenzii->filter(fn ($r) => $r->rating !== null);
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => 'Galle Silva SRL',
            'url' => rtrim(url('/'), '/'),
            'review' => $recenzii->map(fn ($r) => array_filter([
                '@type' => 'Review',
                'author' => ['@type' => 'Person', 'name' => $r->nume_client],
                'reviewBody' => $r->text,
                'datePublished' => $r->data?->toDateString(),
                'reviewRating' => $r->rating
                    ? ['@type' => 'Rating', 'ratingValue' => $r->rating, 'bestRating' => 5]
                    : null,
            ], fn ($v) => $v !== null))->values()->all(),
        ];
        if ($rated->count() >= 3) {
            $schema['aggregateRating'] = [
                '@type' => 'AggregateRating',
                'ratingValue' => round((float) $rated->avg('rating'), 1),
                'reviewCount' => $rated->count(),
                'bestRating' => 5,
            ];
        }
    }
@endphp

{{-- Fara recenzii publicate, sectiunea nu se afiseaza deloc. --}}
@if($recenzii->isNotEmpty())
    @push('seo')
        <x-json-ld :data="$schema" />
    @endpush

    <section class="bg-mist/40 py-20 lg:py-28 px-4 md:px-0">
        <div class="max-w-7xl mx-auto">
            @if($eyebrow)
                <p class="text-sm uppercase tracking-[0.2em] text-forest/50 text-center">{{ $eyebrow }}</p>
            @endif
            <h2 class="mt-3 text-center font-display text-2xl md:text-3xl lg:text-4xl font-bold text-forest text-balance break-words hyphens-auto">{{ $titlu }}</h2>

            <div class="mt-12 grid gap-6 sm:grid-cols-2 {{ $recenzii->count() >= 3 ? 'lg:grid-cols-3' : '' }}">
                @foreach($recenzii as $recenzie)
                    <figure class="flex flex-col rounded-2xl bg-white border border-forest/15 p-7 shadow-lg shadow-forest/10">
                        @if($recenzie->rating)
                            <div class="flex gap-1" aria-label="{{ $recenzie->rating }} din 5 stele">
                                @for($stea = 1; $stea <= 5; $stea++)
                                    <svg class="h-4 w-4 {{ $stea <= $recenzie->rating ? 'text-mint' : 'text-forest/15' }}" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z" clip-rule="evenodd" />
                                    </svg>
                                @endfor
                            </div>
                        @endif

                        <blockquote class="mt-4 flex-1 text-sm font-light leading-relaxed text-forest/80">
                            „{{ $recenzie->text }}”
                        </blockquote>

                        <figcaption class="mt-6 flex items-center gap-3">
                            @if($recenzie->imagine)
                                <img src="{{ str_starts_with($recenzie->imagine, 'http') || str_starts_with($recenzie->imagine, '/') ? $recenzie->imagine : asset('images/'.$recenzie->imagine) }}"
                                     alt="{{ $recenzie->nume_client }}"
                                     class="h-10 w-10 rounded-full object-cover" loading="lazy">
                            @else
                                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-forest text-mist-warm text-sm font-semibold" aria-hidden="true">
                                    {{ $recenzie->initiale() }}
                                </span>
                            @endif
                            <div>
                                <p class="text-sm font-semibold text-forest">{{ $recenzie->nume_client }}</p>
                                <p class="text-xs text-forest/60">
                                    {{ collect([$recenzie->localitate, $recenzie->sursa ? __('via').' '.$recenzie->sursa : null])->filter()->implode(' · ') }}
                                </p>
                            </div>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>
@endif
