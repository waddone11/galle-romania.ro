@php $loc = app()->getLocale(); @endphp

<section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid md:grid-cols-2 gap-8">
        @if(($aTitlu = ($data['a_titlu'][$loc] ?? $data['a_titlu']['ro'] ?? null)) || ($aText = ($data['a_text'][$loc] ?? $data['a_text']['ro'] ?? null)))
            <a href="{{ $data['a_cta_url'] ?? '#' }}" class="group relative overflow-hidden rounded-2xl bg-forest p-8 text-mist-warm hover:scale-[1.02] transition-transform">
                @if($aTitlu)<h3 class="font-display text-2xl mb-3">{{ $aTitlu }}</h3>@endif
                @if($aText)<p class="text-mist-warm/80 mb-6">{{ $aText }}</p>@endif
                @if($aCta = ($data['a_cta_text'][$loc] ?? $data['a_cta_text']['ro'] ?? null))
                    <span class="inline-flex items-center gap-2 text-mint font-medium">{{ $aCta }} <span class="group-hover:translate-x-1 transition-transform">→</span></span>
                @endif
            </a>
        @endif
        @if(($bTitlu = ($data['b_titlu'][$loc] ?? $data['b_titlu']['ro'] ?? null)) || ($bText = ($data['b_text'][$loc] ?? $data['b_text']['ro'] ?? null)))
            <a href="{{ $data['b_cta_url'] ?? '#' }}" class="group relative overflow-hidden rounded-2xl bg-mist-warm border-2 border-forest p-8 text-forest hover:scale-[1.02] transition-transform">
                @if($bTitlu)<h3 class="font-display text-2xl mb-3">{{ $bTitlu }}</h3>@endif
                @if($bText)<p class="text-forest-dark/80 mb-6">{{ $bText }}</p>@endif
                @if($bCta = ($data['b_cta_text'][$loc] ?? $data['b_cta_text']['ro'] ?? null))
                    <span class="inline-flex items-center gap-2 text-forest font-medium">{{ $bCta }} <span class="group-hover:translate-x-1 transition-transform">→</span></span>
                @endif
            </a>
        @endif
    </div>
</section>
