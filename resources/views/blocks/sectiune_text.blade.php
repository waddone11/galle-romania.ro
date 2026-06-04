@php
    $loc = app()->getLocale();
    $titlu = $data['titlu'][$loc] ?? $data['titlu']['ro'] ?? null;
    $continut = $data['continut'][$loc] ?? $data['continut']['ro'] ?? null;

    // Escapam tot HTML-ul, apoi permitem DOAR link-uri interne in stil
    // markdown — [text](/url) — pentru interlinking editabil din admin.
    $html = null;
    if ($continut) {
        $html = nl2br((string) preg_replace(
            '/\[([^\]]+)\]\((\/[^)\s]*)\)/',
            '<a href="$2" class="font-semibold text-forest underline underline-offset-2 hover:text-mint transition-colors">$1</a>',
            e($continut)
        ));
    }
@endphp

@if($titlu || $html)
    <section class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            @if($titlu)
                <h2 class="font-display text-2xl md:text-3xl font-semibold mb-4">{{ $titlu }}</h2>
            @endif
            @if($html)
                <div class="text-forest-dark/80 leading-relaxed space-y-3">{!! $html !!}</div>
            @endif
        </div>
    </section>
@endif
