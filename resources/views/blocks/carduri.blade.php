@php $loc = app()->getLocale(); @endphp

<section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($data['items'] ?? [] as $card)
            <div class="bg-mist-warm rounded-2xl p-6">
                @if(! empty($card['icon']))
                    <div class="size-10 mb-4 rounded-full bg-mint/20 text-mint flex items-center justify-center text-lg font-bold" aria-hidden="true">
                        {{ strtoupper(substr($card['icon'], -1)) }}
                    </div>
                @endif
                @if($titlu = ($card['titlu'][$loc] ?? $card['titlu']['ro'] ?? null))
                    <h3 class="font-display text-xl font-semibold mb-2">{{ $titlu }}</h3>
                @endif
                @if($text = ($card['text'][$loc] ?? $card['text']['ro'] ?? null))
                    <p class="text-forest-dark/80 text-sm">{{ $text }}</p>
                @endif
            </div>
        @endforeach
    </div>
</section>
