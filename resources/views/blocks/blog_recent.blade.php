@php
    $loc = app()->getLocale();
    $prefix = $loc === 'ro' ? '' : '/'.$loc;
    $t = fn (string $key) => $data[$key][$loc] ?? $data[$key]['ro'] ?? null;

    // Datele vin din modelul Articol (publicate, cele mai noi), nu din block.
    $articole = \App\Models\Articol::where('is_published', true)
        ->orderByDesc('published_at')
        ->limit(3)
        ->get();

    // Dimensiuni intrinseci pentru randare fara CLS (acelasi tratament ca site/blog).
    $imgMeta = function (?string $url): array {
        if (! $url || ! str_starts_with($url, '/') || ! is_file(public_path(ltrim($url, '/')))) {
            return [1254, 705];
        }

        return getimagesize(public_path(ltrim($url, '/'))) ?: [1254, 705];
    };
@endphp

@if($articole->isNotEmpty())
<section class="bg-mist/40 py-16 lg:py-24 px-4 md:px-0">
    <div class="max-w-7xl mx-auto">
        @if($eyebrow = $t('eyebrow'))
            <p class="text-sm uppercase tracking-[0.2em] text-forest/50 text-center">{{ $eyebrow }}</p>
        @endif
        @if($titlu = $t('titlu'))
            <h2 class="mt-3 text-center font-display text-3xl lg:text-4xl font-bold text-forest">{{ $titlu }}</h2>
        @endif

        <div class="mt-12 grid md:grid-cols-3 gap-6">
            @foreach($articole as $art)
                @php
                    $aTitlu = $art->getTranslation('titlu', $loc) ?: $art->getTranslation('titlu', 'ro');
                    $imagine = $art->imagine;
                    $jpg = $imagine ? preg_replace('/\.webp$/', '.jpg', $imagine) : null;
                    [$imgW, $imgH] = $imgMeta($imagine);
                @endphp
                <a href="{{ $prefix }}/blog/{{ $art->slug }}" class="block group">
                    @if($imagine)
                        <picture>
                            @if(str_ends_with($imagine, '.webp'))
                                <source srcset="{{ $imagine }}" type="image/webp">
                            @endif
                            <img src="{{ $jpg }}" alt="{{ $aTitlu }}"
                                 width="{{ $imgW }}" height="{{ $imgH }}" loading="lazy" decoding="async"
                                 class="aspect-video w-full rounded-xl object-cover mb-3 group-hover:scale-[1.02] transition-transform duration-300">
                        </picture>
                    @else
                        <div class="aspect-video rounded-xl bg-forest/10 mb-3"></div>
                    @endif
                    <h3 class="font-display text-lg font-semibold group-hover:text-mint transition-colors">{{ $aTitlu }}</h3>
                    <p class="text-sm text-forest-dark/70 mt-2 line-clamp-2">{{ $art->getTranslation('excerpt', $loc) ?: $art->getTranslation('excerpt', 'ro') }}</p>
                </a>
            @endforeach
        </div>

        <div class="mt-10 text-center">
            <a href="{{ $prefix }}/blog" class="inline-flex items-center gap-2 text-forest font-semibold hover:text-mint transition-colors">
                {{ __('Vezi blogul') }}
                <span aria-hidden="true">→</span>
            </a>
        </div>
    </div>
</section>
@endif
