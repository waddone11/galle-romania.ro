@php
    $loc = app()->getLocale();
    $prefix = $loc === 'ro' ? '' : '/'.$loc;
    $t = fn (string $key) => $data[$key][$loc] ?? $data[$key]['ro'] ?? null;

    // Datele vin din modelul Articol (publicate, cele mai noi), nu din block.
    $articole = \App\Models\Articol::where('is_published', true)
        ->orderByDesc('published_at')
        ->limit(4)
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
{{-- Split 50/50 in stilul durabilitate_stat — verde pe STANGA (in oglinda cu sectiunea FAQ). --}}
<section class="grid lg:grid-cols-2 overflow-hidden">
    {{-- Panou verde (stanga pe desktop, sus pe mobil) — full-bleed. --}}
    <div class="bg-forest text-mist px-6 lg:px-16 py-14 lg:py-28 flex items-center lg:order-1">
        <div class="max-w-md lg:ml-auto lg:mr-12">
            <p class="font-display font-extrabold leading-[0.9] tracking-tight text-7xl sm:text-8xl lg:text-[10rem] uppercase" aria-hidden="true">
                Blog<span class="text-mint">.</span>
            </p>
            <h2 class="mt-4 font-display font-extrabold text-mint text-3xl sm:text-4xl leading-tight">
                {{ $t('titlu') ?? 'Ghiduri & noutăți' }}
            </h2>
            <p class="mt-5 text-lg font-light text-mist/75 leading-relaxed">
                {{ $t('subtitlu') ?? 'Despre lemn de foc, pădure și lucrări făcute corect — pe înțelesul tuturor.' }}
            </p>
            <a href="{{ $prefix }}/blog"
               class="mt-8 inline-flex items-center rounded-full bg-mint px-6 py-2.5 text-sm font-semibold text-forest hover:brightness-105 transition">
                {{ __('Vezi blogul') }}
            </a>
        </div>
    </div>

    {{-- 4 articole, grid 2x2, pe alb (dreapta pe desktop). --}}
    <div class="bg-white px-4 sm:px-6 lg:px-16 py-14 lg:py-24 flex items-center lg:order-2">
        <div class="w-full max-w-2xl mx-auto lg:mx-0 grid sm:grid-cols-2 gap-x-6 gap-y-10">
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
                    <h3 class="font-display text-lg font-semibold leading-snug group-hover:text-mint transition-colors">{{ $aTitlu }}</h3>
                    <p class="text-sm text-forest-dark/70 mt-2 line-clamp-2">{{ $art->getTranslation('excerpt', $loc) ?: $art->getTranslation('excerpt', 'ro') }}</p>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif
