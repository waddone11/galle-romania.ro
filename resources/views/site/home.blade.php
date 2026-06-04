@php
    $metaTitle = $pagina?->getTranslation('meta_title', app()->getLocale()) ?: null;
    $metaDesc = $pagina?->getTranslation('meta_description', app()->getLocale()) ?: null;
@endphp
<x-layouts.app
    :title="$metaTitle"
    :metaDescription="$metaDesc"
    :flush-header="true"
>
    {{-- Homepage is rendered 1:1 from the CMS Builder (Pagina[slug=home].sectiuni).
         Default flow seeded: hero → splitter → carduri → solutie_verde →
         durabilitate_stat → reciclare → cta. Editable in /admin → Pagina = home. --}}
    @if($pagina && is_array($pagina->sectiuni) && count($pagina->sectiuni))
        @foreach($pagina->sectiuni as $block)
            @php
                $type = is_array($block) ? ($block['type'] ?? null) : null;
                $blockData = is_array($block) ? ($block['data'] ?? []) : [];
            @endphp
            @if($type && view()->exists("blocks.$type"))
                @include("blocks.$type", ['data' => $blockData])
            @endif
        @endforeach
    @else
        {{-- Fallback: minimal hero if the home page has no Builder content yet. --}}
        @include('blocks.hero', ['data' => []])
        <livewire:audience-splitter />
    @endif
</x-layouts.app>
