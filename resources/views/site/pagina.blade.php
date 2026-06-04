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
@endphp
<x-layouts.app
    :title="$metaTitle"
    :metaDescription="$metaDesc"
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
