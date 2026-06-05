@php
    $loc = app()->getLocale();
    $imgRight = ($data['pozitie'] ?? 'stanga') === 'dreapta';

    $imagine = $data['imagine'] ?? null;
    $jpg = $imagine ? preg_replace('/\.webp$/', '.jpg', $imagine) : null;
    [$imgW, $imgH] = $imagine && str_starts_with($imagine, '/') && is_file(public_path(ltrim($imagine, '/')))
        ? (getimagesize(public_path(ltrim($imagine, '/'))) ?: [1600, 900])
        : [1600, 900];

    $ctaText = $data['cta_text'][$loc] ?? $data['cta_text']['ro'] ?? null;
    $ctaUrl = $data['cta_url'] ?? null;
@endphp

{{-- <section class="py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center">
        <div class="{{ $imgRight ? 'lg:order-1' : 'lg:order-2' }}">
            @if($imagine)
                <picture>
                    @if(str_ends_with($imagine, '.webp'))
                        <source srcset="{{ $imagine }}" type="image/webp">
                    @endif
                    <img src="{{ $jpg }}" alt="" width="{{ $imgW }}" height="{{ $imgH }}"
                         class="w-full h-auto rounded-2xl" loading="lazy" decoding="async">
                </picture>
            @else
                <div class="aspect-video bg-forest/10 rounded-2xl"></div>
            @endif
        </div>
        <div class="{{ $imgRight ? 'lg:order-2' : 'lg:order-1' }}">
            @if($titlu = ($data['titlu'][$loc] ?? $data['titlu']['ro'] ?? null))
                <h2 class="font-display text-2xl md:text-4xl font-semibold mb-4 text-balance break-words hyphens-auto">{{ $titlu }}</h2>
            @endif
            @if($continut = ($data['continut'][$loc] ?? $data['continut']['ro'] ?? null))
                <div class="prose prose-stone max-w-none text-forest-dark/80">
                    {!! nl2br(e($continut)) !!}
                </div>
            @endif
            @if($ctaUrl && $ctaText)
                <a href="{{ $ctaUrl }}" class="mt-8 inline-flex items-center rounded-full border-2 border-forest px-7 py-3 text-sm font-semibold tracking-wide text-forest hover:bg-forest hover:text-mist transition">
                    {{ $ctaText }}
                </a>
            @endif
        </div>
    </div>
</section> --}}

<section class="bg-forest text-mist py-20 lg:py-28 px-4 md:px-0">
    <div class="mx-auto max-w-7xl grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
        <div class="{{ $imgRight ? 'lg:order-1' : 'lg:order-2' }}">
            @if($imagine)
                <picture>
                    @if(str_ends_with($imagine, '.webp'))
                        <source srcset="{{ $imagine }}" type="image/webp">
                    @endif
                    <img src="{{ $jpg }}" alt="" width="{{ $imgW }}" height="{{ $imgH }}"
                         class="w-full h-auto rounded-2xl ring-1 ring-mint/20 shadow-2xl shadow-black/30" loading="lazy" decoding="async">
                </picture>
            @else
                <div class="aspect-video bg-mist/10 rounded-2xl ring-1 ring-mint/20"></div>
            @endif
        </div>
        <div class="{{ $imgRight ? 'lg:order-2' : 'lg:order-1' }}">
            @if($titlu = ($data['titlu'][$loc] ?? $data['titlu']['ro'] ?? null))
                <h2 class="font-display text-2xl md:text-4xl lg:text-5xl font-semibold leading-tight mb-5 text-balance break-words hyphens-auto">{{ $titlu }}</h2>
            @endif
            @if($continut = ($data['continut'][$loc] ?? $data['continut']['ro'] ?? null))
                <div class="prose prose-invert max-w-none text-mist/75 leading-relaxed">
                    {!! nl2br(e($continut)) !!}
                </div>
            @endif
            @if($ctaUrl && $ctaText)
                <a href="{{ $ctaUrl }}" class="mt-8 inline-flex items-center rounded-full bg-mint px-8 py-3.5 text-sm font-bold tracking-wide text-forest hover:brightness-105 transition">
                    {{ $ctaText }}
                </a>
            @endif
        </div>
    </div>
</section>
