@php
    $loc = app()->getLocale();
    $legalTitlu = $pagina->getTranslation('titlu', $loc) ?: $pagina->getTranslation('titlu', 'ro');
    $legalMeta = $pagina->getTranslation('meta_description', $loc) ?: null;
@endphp
<x-layouts.app
    :title="$legalTitlu.' | Galle Silva'"
    :metaDescription="$legalMeta"
>
    <article class="py-16">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <h1 class="font-display text-3xl md:text-5xl font-semibold mb-8 text-balance break-words hyphens-auto">{{ $pagina->getTranslation('titlu', app()->getLocale()) ?: $pagina->getTranslation('titlu', 'ro') }}</h1>

            @if(is_array($pagina->sectiuni) && count($pagina->sectiuni) > 0)
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
                <div class="prose prose-stone max-w-none">
                    <p>{{ __('Continut in pregatire. Pentru detalii contactati-ne la') }} <a href="mailto:contact@galle-silva.com">contact@galle-silva.com</a>.</p>
                </div>
            @endif
        </div>
    </article>
</x-layouts.app>
