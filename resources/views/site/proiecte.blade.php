<x-layouts.app
    :title="__('Proiecte — portofoliu Galle Silva')"
    :metaDescription="__('Portofoliul Galle Silva: lucrari forestiere, peisagistica si compostare pentru primarii, proprietari privati si companii in Prahova, Ilfov si Bucuresti.')"
>
    <section class="bg-forest text-mist-warm py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-display text-4xl md:text-5xl font-semibold">{{ __('Proiecte') }}</h1>
            <p class="mt-4 text-lg text-mist">{{ __('Portofoliu Galle Silva — lucrari pentru primarii, proprietari privati si companii.') }}</p>
        </div>
    </section>
    <section class="py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($proiecte as $p)
                <a href="/proiecte/{{ $p->slug }}" class="block group">
                    <div class="aspect-video rounded-xl bg-forest/10 mb-3 overflow-hidden"></div>
                    <p class="text-xs uppercase tracking-widest text-mint font-medium">{{ $p->categorie }} · {{ $p->an }}</p>
                    <h2 class="font-display text-xl font-semibold mt-1 group-hover:text-mint">{{ $p->getTranslation('titlu', app()->getLocale()) ?: $p->getTranslation('titlu', 'ro') }}</h2>
                    <p class="text-sm text-forest-dark/70 mt-2 line-clamp-2">{{ $p->getTranslation('descriere', app()->getLocale()) ?: $p->getTranslation('descriere', 'ro') }}</p>
                    @if($p->locatie)
                        <p class="text-xs text-forest-dark/50 mt-2">{{ $p->locatie }}</p>
                    @endif
                </a>
            @empty
                <p class="col-span-full text-center text-forest-dark/60">{{ __('Nu sunt proiecte publicate inca.') }}</p>
            @endforelse
        </div>
    </section>
</x-layouts.app>
