@php
    $loc = app()->getLocale();
    $aTitlu = $articol->getTranslation('titlu', $loc) ?: $articol->getTranslation('titlu', 'ro');
    $aExcerpt = $articol->getTranslation('excerpt', $loc) ?: $articol->getTranslation('excerpt', 'ro');
    $aContinut = $articol->getTranslation('continut', $loc) ?: $articol->getTranslation('continut', 'ro');

    $imagine = $articol->imagine;
    $jpg = $imagine ? preg_replace('/\.webp$/', '.jpg', $imagine) : null;
    [$imgW, $imgH] = $imagine && str_starts_with($imagine, '/') && is_file(public_path(ltrim($imagine, '/')))
        ? (getimagesize(public_path(ltrim($imagine, '/'))) ?: [1254, 705])
        : [1254, 705];
@endphp
<x-layouts.app
    :title="$aTitlu.' | Blog Galle Silva'"
    :metaDescription="\Illuminate\Support\Str::limit(strip_tags($aExcerpt), 155)"
    :ogImage="$jpg ? asset(ltrim($jpg, '/')) : null"
    ogType="article"
>
    @push('seo')
        <x-json-ld :data="array_filter([
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $aTitlu,
            'description' => strip_tags($aExcerpt),
            'image' => $jpg ? asset(ltrim($jpg, '/')) : null,
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
                ['@type' => 'ListItem', 'position' => 1, 'name' => __('Acasa'), 'item' => url((app()->getLocale() === 'ro' ? '' : '/'.app()->getLocale()).'/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => __('Blog'), 'item' => url((app()->getLocale() === 'ro' ? '' : '/'.app()->getLocale()).'/blog')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $aTitlu, 'item' => url()->current()],
            ],
        ]" />
    @endpush

    <article class="py-16">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <a href="/blog" class="text-sm text-mint hover:text-forest">← {{ __('Inapoi la blog') }}</a>
            <p class="text-xs uppercase tracking-widest text-mint font-medium mt-6 mb-2">{{ $articol->categorie }}</p>
            <h1 class="font-display text-3xl md:text-5xl font-semibold mb-4 text-balance break-words hyphens-auto">{{ $aTitlu }}</h1>
            @if($articol->published_at)
                <p class="text-forest-dark/60 mb-8">{{ $articol->published_at->format('d.m.Y') }}</p>
            @endif

            @if($imagine)
                <picture>
                    @if(str_ends_with($imagine, '.webp'))
                        <source srcset="{{ $imagine }}" type="image/webp">
                    @endif
                    <img src="{{ $jpg }}" alt="{{ $aTitlu }}" width="{{ $imgW }}" height="{{ $imgH }}"
                         loading="lazy" decoding="async"
                         class="aspect-video w-full rounded-2xl object-cover mb-8">
                </picture>
            @endif

            <p class="text-lg text-forest-dark/80 mb-6 font-medium">{{ $aExcerpt }}</p>
            {{-- Markdown-lite securizat (##/###, liste, **bold**, link-uri interne) — vezi App\Support\BlogMarkdown. --}}
            <div class="max-w-none text-forest-dark/80 leading-relaxed">
                {!! \App\Support\BlogMarkdown::toHtml((string) $aContinut) !!}
            </div>
        </div>
    </article>
</x-layouts.app>
