@php
    $loc = app()->getLocale();
    $metaTitle = ($pagina?->getTranslation('meta_title', $loc) ?: $pagina?->getTranslation('meta_title', 'ro'))
        ?: 'Despre Galle Silva — standarde germane în silvicultură';
    $metaDesc = ($pagina?->getTranslation('meta_description', $loc) ?: $pagina?->getTranslation('meta_description', 'ro'))
        ?: 'Galle Silva este reprezentanța în România a grupului german Galle GmbH. Utilaje moderne, echipă specializată, exploatare responsabilă în Prahova.';
@endphp
<x-layouts.app
    :title="$metaTitle"
    :metaDescription="$metaDesc"
>
    {{-- Continutul (H1, pasii, echipa) vine din CMS: Pagina[slug=despre].sectiuni --}}
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
        <section class="bg-forest text-mist-warm py-16">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="font-display text-4xl md:text-5xl font-semibold">Despre Galle Silva</h1>
                <p class="mt-4 text-lg text-mist max-w-2xl mx-auto">
                    Reprezentanța în România a grupului german Galle GmbH — standarde germane în gestiunea pădurii.
                </p>
            </div>
        </section>
    @endif

    {{-- Banda compacta de certificari (element de incredere, langa povestea grupului Galle GmbH) --}}
    @if($certificari->count() > 0)
        <section class="bg-mist-warm py-12">
            <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="font-display text-2xl font-semibold text-forest mb-6">{{ __('Standarde si certificari') }}</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                    @foreach($certificari as $cert)
                        <x-certificare-card :cert="$cert" variant="compact" />
                    @endforeach
                </div>
                <a href="{{ route('certificari') }}" class="inline-block mt-6 text-forest font-semibold hover:text-mint">{{ __('Vezi toate certificarile') }} →</a>
            </div>
        </section>
    @endif

    {{-- Urmareste-ne — randat doar daca exista cel putin un link social in config --}}
    @if(array_filter(config('social', []), fn ($url) => filled($url)))
        <section class="py-10">
            <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-center gap-2 text-center">
                <span class="text-sm text-forest-dark/60 uppercase tracking-widest">{{ __('Urmareste-ne') }}</span>
                <x-social-links variant="inline" />
            </div>
        </section>
    @endif
</x-layouts.app>
