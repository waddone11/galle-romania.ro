@php
    $loc = app()->getLocale();
    $imgRight = ($data['pozitie'] ?? 'stanga') === 'dreapta';
@endphp

<section class="py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center">
        <div class="{{ $imgRight ? 'lg:order-1' : 'lg:order-2' }}">
            @if(! empty($data['imagine']))
                <img src="{{ $data['imagine'] }}" alt="" class="w-full h-auto rounded-2xl">
            @else
                <div class="aspect-video bg-forest/10 rounded-2xl"></div>
            @endif
        </div>
        <div class="{{ $imgRight ? 'lg:order-2' : 'lg:order-1' }}">
            @if($titlu = ($data['titlu'][$loc] ?? $data['titlu']['ro'] ?? null))
                <h2 class="font-display text-3xl md:text-4xl font-semibold mb-4">{{ $titlu }}</h2>
            @endif
            @if($continut = ($data['continut'][$loc] ?? $data['continut']['ro'] ?? null))
                <div class="prose prose-stone max-w-none text-forest-dark/80">
                    {!! nl2br(e($continut)) !!}
                </div>
            @endif
        </div>
    </div>
</section>
