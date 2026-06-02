@php
    $loc = app()->getLocale();
    $aTitlu = $articol->getTranslation('titlu', $loc) ?: $articol->getTranslation('titlu', 'ro');
    $aExcerpt = $articol->getTranslation('excerpt', $loc) ?: $articol->getTranslation('excerpt', 'ro');
@endphp
<x-layouts.app
    :title="$aTitlu.' | Blog Galle Silva'"
    :metaDescription="\Illuminate\Support\Str::limit(strip_tags($aExcerpt), 155)"
    ogType="article"
>
    @push('seo')
        <x-json-ld :data="array_filter([
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $aTitlu,
            'description' => strip_tags($aExcerpt),
            'datePublished' => $articol->published_at?->toIso8601String(),
            'dateModified' => $articol->updated_at?->toIso8601String(),
            'author' => ['@type' => 'Organization', 'name' => 'Galle Silva'],
            'publisher' => ['@type' => 'Organization', 'name' => 'Galle Silva SRL'],
            'mainEntityOfPage' => url()->current(),
        ], fn ($v) => $v !== null && $v !== '')" />

        <x-json-ld :data="[
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Acasa', 'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => url('/blog')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $aTitlu, 'item' => url()->current()],
            ],
        ]" />
    @endpush

    <article class="py-16">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <a href="/blog" class="text-sm text-mint hover:text-forest">← Inapoi la blog</a>
            <p class="text-xs uppercase tracking-widest text-mint font-medium mt-6 mb-2">{{ $articol->categorie }}</p>
            <h1 class="font-display text-4xl md:text-5xl font-semibold mb-4">{{ $articol->getTranslation('titlu', 'ro') }}</h1>
            @if($articol->published_at)
                <p class="text-forest-dark/60 mb-8">{{ $articol->published_at->format('d.m.Y') }}</p>
            @endif
            <div class="aspect-video rounded-2xl bg-forest/10 mb-8"></div>
            <p class="text-lg text-forest-dark/80 mb-6 font-medium">{{ $articol->getTranslation('excerpt', 'ro') }}</p>
            <div class="prose prose-stone max-w-none">
                {!! nl2br(e($articol->getTranslation('continut', 'ro'))) !!}
            </div>
        </div>
    </article>
</x-layouts.app>
