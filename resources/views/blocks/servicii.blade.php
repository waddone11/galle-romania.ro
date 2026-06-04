@php
    $loc = app()->getLocale();
    $t = fn (string $key) => $data[$key][$loc] ?? $data[$key]['ro'] ?? null;

    $eyebrow = $t('eyebrow') ?? 'Ce facem';
    $titlu   = $t('titlu') ?? 'Servicii forestiere complete';

    $items = collect($data['items'] ?? [])
        ->map(fn ($i) => [
            'icon'    => $i['icon'] ?? 'frunza',
            'titlu'   => $i['titlu'][$loc] ?? $i['titlu']['ro'] ?? null,
            'text'    => $i['text'][$loc] ?? $i['text']['ro'] ?? null,
            'imagine' => $i['imagine'] ?? null,
            'url'     => $i['url'] ?? null,
        ])
        ->filter(fn ($i) => filled($i['titlu']))
        ->values();
@endphp

<section class="bg-white py-6 lg:py-28 px-4 md:px-0">
    <div class="max-w-7xl mx-auto">
        <div class="text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-forest/50">{{ $eyebrow }}</p>
            <h2 class="mt-3 font-display text-4xl lg:text-5xl font-bold text-forest">{{ $titlu }}</h2>
        </div>

        <div class="mt-14 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($items as $item)
                @php
                    // Derive the .jpg fallback + intrinsic size for CLS-free rendering.
                    $webp = $item['imagine'];
                    $jpg = $webp ? preg_replace('/\.webp$/', '.jpg', $webp) : null;
                    [$imgW, $imgH] = $webp && is_file(public_path(ltrim($webp, '/')))
                        ? (getimagesize(public_path(ltrim($webp, '/'))) ?: [1600, 900])
                        : [1600, 900];
                @endphp
                <article class="group flex flex-col overflow-hidden rounded-3xl border border-forest bg-[#fafaf8] transition hover:-translate-y-1 hover:shadow-lg hover:shadow-forest/10">
                    @if($webp)
                        <picture>
                            <source srcset="{{ asset(ltrim($webp, '/')) }}" type="image/webp">
                            <img src="{{ asset(ltrim($jpg, '/')) }}"
                                 alt="{{ $item['titlu'] }}"
                                 width="{{ $imgW }}" height="{{ $imgH }}"
                                 loading="lazy" decoding="async"
                                 class="aspect-[16/10] w-full object-cover">
                        </picture>
                    @endif

                    <div class="flex flex-1 flex-col p-7">
                        <div class="flex items-center gap-4">
                            <span class="grid h-12 w-12 shrink-0 place-items-center rounded-full bg-forest text-white">
                                <x-galle-icon :icon="$item['icon']" :size="22" />
                            </span>
                            <h3 class="font-display text-xl font-bold text-forest">{{ $item['titlu'] }}</h3>
                        </div>

                        @if($item['text'])
                            <p class="mt-4 text-sm font-light leading-relaxed text-forest/90">{{ $item['text'] }}</p>
                        @endif

                        @if($item['url'])
                            <a href="{{ $item['url'] }}" class="mt-auto pt-5 inline-flex items-center gap-1 text-sm font-semibold text-forest group-hover:text-mint transition-colors">
                                {{ __('Detalii') }} <span aria-hidden="true">→</span>
                            </a>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
