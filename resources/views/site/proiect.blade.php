@php
    $loc = app()->getLocale();
    $pTitlu = $proiect->getTranslation('titlu', $loc) ?: $proiect->getTranslation('titlu', 'ro');
    $pDesc = $proiect->getTranslation('descriere', $loc) ?: $proiect->getTranslation('descriere', 'ro');
@endphp
<x-layouts.app
    :title="$pTitlu.' — Proiecte | Galle Silva'"
    :metaDescription="\Illuminate\Support\Str::limit(strip_tags($pDesc), 155)"
>
    @push('seo')
        <x-json-ld :data="[
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => __('Acasa'), 'item' => url((app()->getLocale() === 'ro' ? '' : '/'.app()->getLocale()).'/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => __('Proiecte'), 'item' => url((app()->getLocale() === 'ro' ? '' : '/'.app()->getLocale()).'/proiecte')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $pTitlu, 'item' => url()->current()],
            ],
        ]" />
    @endpush

    <article class="py-16">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <a href="/proiecte" class="text-sm text-mint hover:text-forest">← {{ __('Toate proiectele') }}</a>
            <p class="text-xs uppercase tracking-widest text-mint font-medium mt-6 mb-2">{{ $proiect->categorie }} · {{ $proiect->an }}</p>
            <h1 class="font-display text-3xl md:text-5xl font-semibold mb-4 text-balance break-words hyphens-auto">{{ $pTitlu }}</h1>
            @if($proiect->locatie)
                <p class="text-forest-dark/60 mb-8">{{ $proiect->locatie }}</p>
            @endif
            @php $galerie = $proiect->galerieUrls(); @endphp
            @if($galerie !== [])
                <div class="aspect-video rounded-2xl bg-forest/10 mb-8 overflow-hidden">
                    <img src="{{ $galerie[0] }}"
                         alt="{{ $pTitlu }}"
                         width="1600" height="900" fetchpriority="high" decoding="async"
                         class="w-full h-full object-cover">
                </div>
            @else
                <div class="aspect-video rounded-2xl bg-forest/10 mb-8 grid place-items-center">
                    <svg class="size-12 text-forest/30" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 19.5h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/>
                    </svg>
                </div>
            @endif
            <p class="text-lg text-forest-dark/80 mb-6">{{ $pDesc }}</p>
            <div class="prose prose-stone max-w-none">
                {!! nl2br(e($proiect->getTranslation('continut', $loc) ?: $proiect->getTranslation('continut', 'ro'))) !!}
            </div>

            @if(count($galerie) > 1)
                <div class="mt-10 grid grid-cols-2 sm:grid-cols-3 gap-3">
                    @foreach(array_slice($galerie, 1) as $imgUrl)
                        <div class="aspect-square rounded-xl overflow-hidden bg-forest/10">
                            <img src="{{ $imgUrl }}"
                                 alt="{{ $pTitlu }} — {{ $loop->iteration }}"
                                 width="800" height="450" loading="lazy" decoding="async"
                                 class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </article>
</x-layouts.app>
