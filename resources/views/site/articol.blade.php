<x-layouts.app>
    <article class="py-16">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <a href="/blog" class="text-sm text-mint hover:text-forest">← Inapoi la blog</a>
            <p class="text-xs uppercase tracking-widest text-mint font-medium mt-6 mb-2">{{ $articol->categorie }}</p>
            <h1 class="font-display text-4xl md:text-5xl font-semibold mb-4">{{ $articol->getTranslation('titlu', 'ro') }}</h1>
            @if($articol->published_at)
                <p class="text-forest-dark/60 mb-8">{{ $articol->published_at->format('d.m.Y') }}</p>
            @endif
            <div class="aspect-video rounded-2xl bg-forest/10 mb-8"></div>
            <p class="text-lg text-forest-dark/80 mb-6 font-medium">{{ $articol->getTranslation('excerpt', 'ro') }}</p>
            <div class="prose prose-stone max-w-none">
                {!! nl2br(e($articol->getTranslation('continut', 'ro'))) !!}
            </div>
        </div>
    </article>
</x-layouts.app>
