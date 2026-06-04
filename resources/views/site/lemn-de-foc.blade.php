@php
    $loc = app()->getLocale();
    $prefix = $loc === 'ro' ? '' : '/'.$loc;
    $localitate = $localitate ?? null;

    $metaTitle = ($pagina?->getTranslation('meta_title', $loc) ?: $pagina?->getTranslation('meta_title', 'ro'))
        ?: 'Lemn de foc Prahova — stejar, carpen, fag, cu livrare | Galle Silva';
    $metaDesc = ($pagina?->getTranslation('meta_description', $loc) ?: $pagina?->getTranslation('meta_description', 'ro'))
        ?: 'Lemn de foc de esență tare (stejar, carpen, fag), tăiat și crăpat, de la 350 lei/m³. Livrare în Prahova, Ilfov și București. Fără cantitate minimă.';

    $h1 = __('Lemn de foc in Prahova, Bucuresti si Ilfov — fag, stejar, carpen');
    $intro = __('Vindem lemn de foc de esenta tare — stejar si carpen pe stoc — de la 350 lei/m³, taiat si crapat, cu livrare in Prahova, Ilfov si Bucuresti, fara cantitate minima.');
    $canonical = null;

    if ($localitate) {
        $localIntro = $localitate->getTranslation('intro', $loc) ?: $localitate->getTranslation('intro', 'ro');
        $h1 = __('Lemn de foc in :localitate — fag, stejar, carpen', ['localitate' => $localitate->nume]);
        $intro = $localIntro ?: __('Livram lemn de foc taiat si crapat in :localitate — de la 350 lei/m³, in 1–3 zile lucratoare.', ['localitate' => $localitate->nume]);
        $metaTitle = __('Lemn de foc :localitate — livrare la domiciliu | Galle Silva', ['localitate' => $localitate->nume]);
        $metaDesc = __('Lemn de foc de esenta tare in :localitate, judetul :judet — stejar si carpen pe stoc, taiat si crapat, de la 350 lei/m³. Livrare in 1–3 zile, fara cantitate minima.', ['localitate' => $localitate->nume, 'judet' => $localitate->judet]);
        // Continutul e mostenit de pe pagina principala — canonical acolo.
        $canonical = url($prefix.'/lemn-de-foc');
    }
@endphp
<x-layouts.app
    :title="$metaTitle"
    :metaDescription="$metaDesc"
    :canonical="$canonical"
    :ogImage="asset('images/galle/proiecte/gramada-busteni-wide.jpg')"
>
    @push('seo')
        @foreach($species as $sp)
            <x-json-ld :data="array_filter([
                '@context' => 'https://schema.org',
                '@type' => 'Product',
                'name' => $sp->getTranslation('nume', $loc) ?: $sp->getTranslation('nume', 'ro'),
                'description' => $sp->getTranslation('descriere', $loc) ?: $sp->getTranslation('descriere', 'ro'),
                'category' => 'Lemn de foc',
                'brand' => ['@type' => 'Brand', 'name' => 'Galle Silva'],
                'offers' => $sp->status->value === 'disponibil' ? [
                    '@type' => 'Offer',
                    'price' => (string) (int) $sp->pret_pornire,
                    'priceCurrency' => 'RON',
                    'availability' => 'https://schema.org/InStock',
                ] : ['@type' => 'Offer', 'availability' => 'https://schema.org/PreOrder', 'priceCurrency' => 'RON'],
            ], fn ($v) => $v !== null && $v !== '')" />
        @endforeach

        @if($faqs->count() > 0)
            <x-json-ld :data="[
                '@context' => 'https://schema.org',
                '@type' => 'FAQPage',
                'mainEntity' => $faqs->map(fn ($faq) => [
                    '@type' => 'Question',
                    'name' => $faq->getTranslation('intrebare', $loc) ?: $faq->getTranslation('intrebare', 'ro'),
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $faq->getTranslation('raspuns', $loc) ?: $faq->getTranslation('raspuns', 'ro'),
                    ],
                ])->values()->all(),
            ]" />
        @endif

        <x-json-ld :data="[
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => array_values(array_filter([
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Acasa', 'item' => url($prefix.'/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Lemn de foc', 'item' => url($prefix.'/lemn-de-foc')],
                $localitate ? ['@type' => 'ListItem', 'position' => 3, 'name' => $localitate->nume, 'item' => url()->current()] : null,
            ])),
        ]" />
    @endpush

    <section class="bg-forest text-mist-warm py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-display text-4xl md:text-5xl font-semibold">{{ $h1 }}</h1>
            <p class="mt-4 text-lg text-mist max-w-3xl mx-auto">{{ $intro }}</p>
        </div>
    </section>

    {{-- Specii --}}
    <section class="py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid md:grid-cols-3 gap-6">
            @foreach($species as $sp)
                <div class="bg-mist-warm rounded-2xl p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="font-display text-xl font-semibold">{{ $sp->getTranslation('nume', $loc) ?: $sp->getTranslation('nume', 'ro') }}</h3>
                        <span class="text-xs px-2 py-1 rounded-full {{ $sp->status->value === 'disponibil' ? 'bg-mint/20 text-forest-dark' : 'bg-amber-100 text-amber-800' }}">
                            {{ __($sp->status->label()) }}
                        </span>
                    </div>
                    <p class="text-sm text-forest-dark/80 mb-4">{{ $sp->getTranslation('descriere', $loc) ?: $sp->getTranslation('descriere', 'ro') }}</p>
                    <dl class="grid grid-cols-2 gap-2 text-sm pt-4 border-t border-forest/10">
                        <div>
                            <dt class="text-forest-dark/60 text-xs">{{ __('Pret pornire') }}</dt>
                            <dd class="font-semibold">{{ number_format($sp->pret_pornire, 0) }} lei</dd>
                        </div>
                        <div>
                            <dt class="text-forest-dark/60 text-xs">{{ __('Putere calorica') }}</dt>
                            <dd class="font-semibold">{{ $sp->putere_calorica }} kWh/kg</dd>
                        </div>
                    </dl>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Sectiuni CMS (pret, esente, cum vindem, livrare & plata, ster vs cub) --}}
    @if($pagina && is_array($pagina->sectiuni))
        <div class="pb-8">
            @foreach($pagina->sectiuni as $block)
                @php
                    $type = is_array($block) ? ($block['type'] ?? null) : null;
                    $blockData = is_array($block) ? ($block['data'] ?? []) : [];
                @endphp
                @if($type && view()->exists("blocks.$type"))
                    @include("blocks.$type", ['data' => $blockData])
                @endif
            @endforeach
        </div>
    @endif

    {{-- Calculator + Order form --}}
    <section class="bg-mist-warm py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12">
            <div>
                <h2 class="font-display text-3xl font-semibold mb-3">{{ __('Calculator pret') }}</h2>
                <p class="text-forest-dark/70 mb-6">{{ __('Estimam in timp real costul total. Comanda direct sau pe WhatsApp.') }}</p>
                <livewire:firewood.price-calculator />
            </div>
            <div>
                <h2 class="font-display text-3xl font-semibold mb-3">{{ __('Comanda lemn') }}</h2>
                <p class="text-forest-dark/70 mb-6">{{ __('Trimite-ne datele tale si te contactam in cel mult 24h pentru confirmare.') }}</p>
                <livewire:firewood.order-form />
            </div>
        </div>
    </section>

    {{-- Zone livrare --}}
    <section class="py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="font-display text-3xl font-semibold mb-8 text-center">{{ __('Unde livram') }}</h2>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($zone as $z)
                    <div class="bg-[#fafaf8] border border-mist rounded-2xl p-6">
                        <h3 class="font-display text-xl font-semibold text-forest mb-2">{{ $z->judet }}</h3>
                        <p class="text-sm text-forest-dark/70 mb-3">{{ __('Cost livrare:') }} <strong>{{ number_format($z->cost_livrare, 0) }} lei</strong></p>
                        @if(is_array($z->localitati))
                            <p class="text-xs text-forest-dark/60">{{ implode(', ', $z->localitati) }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    @if($faqs->count() > 0)
        <section class="bg-mist-warm py-16">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                <h2 class="font-display text-3xl font-semibold mb-8 text-center">{{ __('Intrebari frecvente') }}</h2>
                <div class="space-y-4">
                    @foreach($faqs as $faq)
                        <details class="bg-[#fafaf8] rounded-xl p-4 group">
                            <summary class="font-medium cursor-pointer flex justify-between items-center">
                                <span>{{ $faq->getTranslation('intrebare', $loc) ?: $faq->getTranslation('intrebare', 'ro') }}</span>
                                <span class="text-mint group-open:rotate-180 transition-transform">▾</span>
                            </summary>
                            <p class="mt-3 text-sm text-forest-dark/80">{{ $faq->getTranslation('raspuns', $loc) ?: $faq->getTranslation('raspuns', 'ro') }}</p>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.app>
