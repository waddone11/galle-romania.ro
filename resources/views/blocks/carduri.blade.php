@php
    $loc = app()->getLocale();
    $t = fn (string $key) => $data[$key][$loc] ?? $data[$key]['ro'] ?? null;
    $items = $data['items'] ?? [];
    $cols = count($items) === 4 ? 'lg:grid-cols-4' : (count($items) === 3 ? 'lg:grid-cols-3' : 'lg:grid-cols-2');
@endphp

<section class="bg-mist/40 py-20 lg:py-28 px-6">
    <div class="max-w-7xl mx-auto">
        @if($eyebrow = $t('eyebrow'))
            <p class="text-sm uppercase tracking-[0.2em] text-forest/50 text-center">{{ $eyebrow }}</p>
        @endif
        @if($titlu = $t('titlu'))
            <h2 class="mt-3 text-center font-display text-3xl lg:text-4xl font-bold text-forest">{{ $titlu }}</h2>
        @endif

        <div class="mt-12 grid sm:grid-cols-2 {{ $cols }} gap-6">
            @foreach($items as $card)
                @php
                    $cTitlu = $card['titlu'][$loc] ?? $card['titlu']['ro'] ?? null;
                    $cText  = $card['text'][$loc] ?? $card['text']['ro'] ?? null;
                @endphp
                <div class="rounded-2xl bg-white border border-mist p-7 hover:border-mint transition">
                    <span class="grid place-items-center size-12 rounded-2xl bg-mint/15 text-forest mb-5" aria-hidden="true">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12l5 5L20 7"/>
                        </svg>
                    </span>
                    @if($cTitlu)<h3 class="font-display text-xl font-bold text-forest mb-2">{{ $cTitlu }}</h3>@endif
                    @if($cText)<p class="text-forest/70 text-sm font-light leading-relaxed">{{ $cText }}</p>@endif
                </div>
            @endforeach
        </div>
    </div>
</section>
