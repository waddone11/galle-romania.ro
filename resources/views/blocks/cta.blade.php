@php $loc = app()->getLocale(); @endphp

<section class="py-16">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <div class="bg-forest text-mist-warm rounded-3xl p-8 md:p-14 text-center">
            @if($titlu = ($data['titlu'][$loc] ?? $data['titlu']['ro'] ?? null))
                <h2 class="font-display text-3xl md:text-4xl font-extrabold mb-3">{{ $titlu }}</h2>
            @endif
            @if($text = ($data['text'][$loc] ?? $data['text']['ro'] ?? null))
                <p class="text-mist mb-6 max-w-2xl mx-auto">{{ $text }}</p>
            @endif
            @if(! empty($data['buton_url']) && ($btnText = ($data['buton_text'][$loc] ?? $data['buton_text']['ro'] ?? null)))
                <a href="{{ $data['buton_url'] }}" class="inline-flex items-center rounded-full bg-mint px-6 py-3 text-forest-dark font-medium hover:scale-105 transition-transform">
                    {{ $btnText }}
                </a>
            @endif
        </div>
    </div>
</section>
