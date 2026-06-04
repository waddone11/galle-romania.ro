{{--
    View generic pentru paginile randate integral din CMS (Pagina.sectiuni).
    Controller-ul paseaza:
      - $pagina  — modelul Pagina (obligatoriu)
      - $schemas — array de structuri JSON-LD (optional)
--}}
@php
    $loc = app()->getLocale();
    $metaTitle = $pagina->getTranslation('meta_title', $loc) ?: $pagina->getTranslation('meta_title', 'ro') ?: null;
    $metaDesc = $pagina->getTranslation('meta_description', $loc) ?: $pagina->getTranslation('meta_description', 'ro') ?: null;

    // og:image: campul og_image al paginii sau imaginea din primul header_pagina (jpg, absolut).
    $ogImage = $pagina->og_image;
    if (! $ogImage && is_array($pagina->sectiuni)) {
        foreach ($pagina->sectiuni as $ogBlock) {
            if (is_array($ogBlock) && ($ogBlock['type'] ?? null) === 'header_pagina' && ! empty($ogBlock['data']['imagine'])) {
                $ogImage = $ogBlock['data']['imagine'];
                break;
            }
        }
    }
    if ($ogImage) {
        $ogImage = asset(ltrim((string) preg_replace('/\.webp$/', '.jpg', $ogImage), '/'));
    }
@endphp
<x-layouts.app
    :title="$metaTitle"
    :metaDescription="$metaDesc"
    :ogImage="$ogImage"
>
    @push('seo')
        @foreach($schemas ?? [] as $schema)
            <x-json-ld :data="$schema" />
        @endforeach
    @endpush

    @if(is_array($pagina->sectiuni))
        @foreach($pagina->sectiuni as $block)
            @php
                $type = is_array($block) ? ($block['type'] ?? null) : null;
                $blockData = is_array($block) ? ($block['data'] ?? []) : [];
            @endphp
            @if($type && view()->exists("blocks.$type"))
                @include("blocks.$type", ['data' => $blockData])
            @endif
        @endforeach
    @endif
</x-layouts.app>
