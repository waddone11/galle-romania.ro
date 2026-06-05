@php
    $loc = app()->getLocale();
    $titlu = $data['titlu'][$loc] ?? $data['titlu']['ro'] ?? null;
    $intro = $data['intro'][$loc] ?? $data['intro']['ro'] ?? null;

    // Imagine hero optionala: varianta -wide pe desktop, patrata (fara -wide) pe mobil.
    $imagine = $data['imagine'] ?? null;
    $imagineSq = $imagine ? str_replace('-wide.', '.', $imagine) : null;
    $jpgWide = $imagine ? preg_replace('/\.webp$/', '.jpg', $imagine) : null;
    [$imgW, $imgH] = $imagine && str_starts_with($imagine, '/') && is_file(public_path(ltrim($imagine, '/')))
        ? (getimagesize(public_path(ltrim($imagine, '/'))) ?: [1254, 705])
        : [1254, 705];
@endphp

<section class="bg-forest text-mist-warm py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
        @if($titlu)
            <h1 class="font-display text-3xl md:text-5xl font-semibold text-balance break-words hyphens-auto">{{ $titlu }}</h1>
        @endif
        @if($intro)
            <p class="mt-4 text-lg text-mist max-w-3xl mx-auto">{{ $intro }}</p>
        @endif

        @if($imagine)
            <picture>
                {{-- desktop: cadrul lat --}}
                <source media="(min-width: 768px)" srcset="{{ $imagine }}" type="image/webp">
                {{-- mobil: varianta patrata --}}
                @if($imagineSq && $imagineSq !== $imagine)
                    <source media="(max-width: 767px)" srcset="{{ $imagineSq }}" type="image/webp">
                @endif
                <img src="{{ $jpgWide }}" alt="{{ $titlu }}"
                     width="{{ $imgW }}" height="{{ $imgH }}"
                     loading="lazy" decoding="async"
                     class="mt-10 w-full max-h-[420px] rounded-3xl object-cover shadow-xl shadow-forest-dark/30">
            </picture>
        @endif
    </div>
</section>
