<x-layouts.app>
    <section class="bg-forest text-mist-warm py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-display text-4xl md:text-5xl font-semibold">Blog</h1>
            <p class="mt-4 text-lg text-mist">Ghiduri, studii, noutati despre lemn de foc, padure si servicii.</p>
        </div>
    </section>

    <section class="py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($articole as $art)
                    <a href="/blog/{{ $art->slug }}" class="block group">
                        <div class="aspect-video rounded-xl bg-forest/10 mb-3"></div>
                        <p class="text-xs uppercase tracking-widest text-mint font-medium">{{ $art->categorie }}</p>
                        <h2 class="font-display text-lg font-semibold mt-1 group-hover:text-mint">{{ $art->getTranslation('titlu', 'ro') }}</h2>
                        <p class="text-sm text-forest-dark/70 mt-2 line-clamp-2">{{ $art->getTranslation('excerpt', 'ro') }}</p>
                        @if($art->published_at)
                            <p class="text-xs text-forest-dark/50 mt-2">{{ $art->published_at->format('d.m.Y') }}</p>
                        @endif
                    </a>
                @empty
                    <p class="col-span-full text-center text-forest-dark/60">Nu sunt articole publicate inca.</p>
                @endforelse
            </div>

            <div class="mt-12">{{ $articole->links() }}</div>
        </div>
    </section>
</x-layouts.app>
