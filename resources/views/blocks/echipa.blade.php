@php
    $loc = app()->getLocale();
    $t = fn (string $key) => $data[$key][$loc] ?? $data[$key]['ro'] ?? null;

    // Datele vin din modelul Membru (activi, ordonati), nu din block.
    $membri = \App\Models\Membru::where('is_active', true)->orderBy('ordine')->get();

    $cols = $membri->count() >= 4 ? 'lg:grid-cols-4' : 'lg:grid-cols-3';
@endphp

@if($membri->isNotEmpty())
<section class="bg-mist/40 py-20 lg:py-28 px-4 md:px-0">
    <div class="max-w-7xl mx-auto">
        @if($eyebrow = $t('eyebrow'))
            <p class="text-sm uppercase tracking-[0.2em] text-forest/50 text-center">{{ $eyebrow }}</p>
        @endif
        @if($titlu = $t('titlu'))
            <h2 class="mt-3 text-center font-display text-3xl lg:text-4xl font-bold text-forest">{{ $titlu }}</h2>
        @endif

        <div class="mt-12 grid sm:grid-cols-2 {{ $cols }} gap-6">
            @foreach($membri as $membru)
                <div class="rounded-2xl bg-white border border-forest/15 p-7 text-center shadow-lg shadow-forest/10">
                    @if($membru->imagine)
                        <img src="{{ str_starts_with($membru->imagine, 'http') || str_starts_with($membru->imagine, '/') ? $membru->imagine : asset('storage/'.$membru->imagine) }}"
                             alt="{{ $membru->nume }}"
                             width="112" height="112" loading="lazy" decoding="async"
                             class="mx-auto h-28 w-28 rounded-full object-cover">
                    @else
                        {{-- Fallback elegant: avatar cu initiale pana se incarca poza din admin. --}}
                        <span class="mx-auto flex h-28 w-28 items-center justify-center rounded-full bg-forest text-mist-warm font-display text-2xl font-semibold" aria-hidden="true">
                            {{ $membru->initiale() }}
                        </span>
                    @endif
                    <h3 class="mt-5 font-display text-lg font-bold text-forest">{{ $membru->nume }}</h3>
                    <p class="mt-1 text-sm text-forest/60">{{ $membru->getTranslation('rol', $loc) ?: $membru->getTranslation('rol', 'ro') }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
