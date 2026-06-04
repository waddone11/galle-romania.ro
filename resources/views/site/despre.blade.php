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

    @if($certificari->count() > 0)
        <section class="bg-mist-warm py-16">
            <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="font-display text-2xl font-semibold mb-8">{{ __('Standarde si certificari') }}</h2>
                <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($certificari as $cert)
                        <div class="bg-[#fafaf8] rounded-xl p-4 text-left">
                            <p class="text-xs uppercase tracking-widest text-mint font-medium mb-1">{{ $cert->tip->value }}</p>
                            <h3 class="font-semibold text-sm mb-1">{{ $cert->nume }}</h3>
                            <span class="text-xs px-2 py-0.5 rounded-full {{ $cert->status->value === 'activ' ? 'bg-mint/20 text-forest-dark' : 'bg-amber-100 text-amber-800' }}">
                                {{ __($cert->status->label()) }}
                            </span>
                        </div>
                    @endforeach
                </div>
                <a href="/certificari" class="inline-block mt-6 text-forest font-semibold hover:text-mint">{{ __('Vezi toate certificarile') }} →</a>
            </div>
        </section>
    @endif
</x-layouts.app>
