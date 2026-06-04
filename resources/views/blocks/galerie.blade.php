@php
    $loc = app()->getLocale();
    $titlu = $data['titlu'][$loc] ?? $data['titlu']['ro'] ?? null;
    $video = $data['video'] ?? null;
    $videoPoster = $data['video_poster'] ?? null;

    // Resolve intrinsic size once per image for CLS-free rendering.
    $imgMeta = function (?string $url): array {
        if (! $url || ! str_starts_with($url, '/') || ! is_file(public_path(ltrim($url, '/')))) {
            return [1600, 900];
        }

        return getimagesize(public_path(ltrim($url, '/'))) ?: [1600, 900];
    };
@endphp

<section class="mx-auto max-w-7xl py-16 px-4 md:px-0">
    @if($titlu)
        <h2 class="font-display text-3xl md:text-4xl font-bold text-forest text-center mb-10">{{ $titlu }}</h2>
    @endif

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
        @if($video)
            {{-- Short muted ambient loop (compressed). --}}
            <div class="row-span-2 rounded-xl overflow-hidden bg-forest/10">
                <video class="w-full h-full object-cover" autoplay muted loop playsinline preload="metadata"
                       @if($videoPoster) poster="{{ asset(ltrim($videoPoster, '/')) }}" @endif>
                    <source src="{{ asset(ltrim($video, '/')) }}" type="video/mp4">
                </video>
            </div>
        @endif

        @foreach($data['imagini'] ?? [] as $img)
            @php
                $url = is_array($img) ? ($img['url'] ?? null) : $img;
                [$w, $h] = $imgMeta($url);
                $jpg = $url ? preg_replace('/\.webp$/', '.jpg', $url) : null;
            @endphp
            @if($url)
                <div class="aspect-square rounded-xl overflow-hidden bg-forest/10">
                    <picture>
                        @if(str_ends_with($url, '.webp'))
                            <source srcset="{{ $url }}" type="image/webp">
                        @endif
                        <img src="{{ $jpg }}" alt="" width="{{ $w }}" height="{{ $h }}"
                             class="w-full h-full object-cover" loading="lazy" decoding="async">
                    </picture>
                </div>
            @endif
        @endforeach
    </div>
</section>
