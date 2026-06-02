@php $loc = app()->getLocale(); @endphp

<section class="relative bg-gradient-to-b from-mist-warm to-[#fafaf8] py-16 lg:py-24">
    @if(! empty($data['imagine']))
        <div class="absolute inset-0 -z-10 bg-cover bg-center opacity-20" style="background-image: url('{{ $data['imagine'] }}')"></div>
    @endif
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 text-center">
        @if($titlu = ($data['titlu'][$loc] ?? $data['titlu']['ro'] ?? null))
            <h2 class="font-display text-4xl md:text-5xl font-semibold text-forest-dark mb-4">{{ $titlu }}</h2>
        @endif
        @if($subtitlu = ($data['subtitlu'][$loc] ?? $data['subtitlu']['ro'] ?? null))
            <p class="text-lg text-forest-dark/80 max-w-2xl mx-auto mb-6">{{ $subtitlu }}</p>
        @endif
        @if(! empty($data['cta_url']) && ($ctaText = ($data['cta_text'][$loc] ?? $data['cta_text']['ro'] ?? null)))
            <a href="{{ $data['cta_url'] }}" class="inline-flex items-center rounded-full bg-forest px-6 py-3 text-mist-warm hover:bg-forest-dark font-medium">
                {{ $ctaText }}
            </a>
        @endif
    </div>
</section>
