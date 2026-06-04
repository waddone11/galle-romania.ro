<x-layouts.app
    :title="__('Blog — ghiduri despre lemn de foc, padure si servicii | Galle Silva')"
    :metaDescription="__('Ghiduri, studii si noutati despre lemn de foc, gestiunea padurii si servicii forestiere, de la echipa Galle Silva.')"
>
    <section class="bg-forest text-mist-warm py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-display text-4xl md:text-5xl font-semibold">Blog</h1>
            <p class="mt-4 text-lg text-mist">{{ __('Ghiduri, studii, noutati despre lemn de foc, padure si servicii.') }}</p>
        </div>
    </section>

    <section class="py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($articole as $art)
                    @php
                        $loc = app()->getLocale();
                        $imagine = $art->imagine;
                        $jpg = $imagine ? preg_replace('/\.webp$/', '.jpg', $imagine) : null;
                        [$imgW, $imgH] = $imagine && str_starts_with($imagine, '/') && is_file(public_path(ltrim($imagine, '/')))
                            ? (getimagesize(public_path(ltrim($imagine, '/'))) ?: [1254, 705])
                            : [1254, 705];
                    @endphp
                    <a href="/blog/{{ $art->slug }}" class="block group">
                        @if($imagine)
                            <picture>
                                @if(str_ends_with($imagine, '.webp'))
                                    <source srcset="{{ $imagine }}" type="image/webp">
                                @endif
                                <img src="{{ $jpg }}" alt="{{ $art->getTranslation('titlu', $loc) ?: $art->getTranslation('titlu', 'ro') }}"
                                     width="{{ $imgW }}" height="{{ $imgH }}" loading="lazy" decoding="async"
                                     class="aspect-video w-full rounded-xl object-cover mb-3">
                            </picture>
                        @else
                            <div class="aspect-video rounded-xl bg-forest/10 mb-3"></div>
                        @endif
                        <p class="text-xs uppercase tracking-widest text-mint font-medium">{{ $art->categorie }}</p>
                        <h2 class="font-display text-lg font-semibold mt-1 group-hover:text-mint">{{ $art->getTranslation('titlu', $loc) ?: $art->getTranslation('titlu', 'ro') }}</h2>
                        <p class="text-sm text-forest-dark/70 mt-2 line-clamp-2">{{ $art->getTranslation('excerpt', $loc) ?: $art->getTranslation('excerpt', 'ro') }}</p>
                        @if($art->published_at)
                            <p class="text-xs text-forest-dark/50 mt-2">{{ $art->published_at->format('d.m.Y') }}</p>
                        @endif
                    </a>
                @empty
                    <p class="col-span-full text-center text-forest-dark/60">Nu sunt articole publicate încă.</p>
                @endforelse
            </div>

            <div class="mt-12">{{ $articole->links() }}</div>
        </div>
    </section>
</x-layouts.app>
