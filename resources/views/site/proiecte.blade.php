<x-layouts.app
    :title="__('Proiecte — portofoliu Galle Silva')"
    :metaDescription="__('Portofoliul Galle Silva: lucrari forestiere, peisagistica si compostare pentru primarii, proprietari privati si companii in Prahova, Ilfov si Bucuresti.')"
>
    <section class="bg-forest text-mist-warm py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-display text-3xl md:text-5xl font-semibold text-balance break-words hyphens-auto">{{ __('Proiecte') }}</h1>
            <p class="mt-4 text-lg text-mist">{{ __('Portofoliu Galle Silva — lucrari pentru primarii, proprietari privati si companii.') }}</p>
        </div>
    </section>
    <section class="py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($proiecte as $p)
                @php $cover = $p->getFirstMedia('galerie'); @endphp
                <a href="/proiecte/{{ $p->slug }}" class="block group">
                    @if($cover)
                        <div class="aspect-video rounded-xl bg-forest/10 mb-3 overflow-hidden">
                            <img src="{{ $cover->getUrl('card') }}"
                                 alt="{{ $p->getTranslation('titlu', app()->getLocale()) ?: $p->getTranslation('titlu', 'ro') }}"
                                 width="800" height="450" loading="lazy" decoding="async"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                    @else
                        {{-- Placeholder elegant pentru proiectele fara imagini. --}}
                        <div class="aspect-video rounded-xl bg-forest/10 mb-3 overflow-hidden grid place-items-center">
                            <svg class="size-10 text-forest/30" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 19.5h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/>
                            </svg>
                        </div>
                    @endif
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
