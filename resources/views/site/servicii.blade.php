<x-layouts.app
    title="Servicii forestiere, peisagistica si compostare | Galle Silva"
    metaDescription="Servicii forestiere, peisagistica si compostare pentru primarii, institutii si companii. Standarde germane Galle GmbH, in Prahova, Ilfov si Bucuresti."
>
    @push('seo')
        @php $loc = app()->getLocale(); @endphp
        @foreach($servicii as $s)
            <x-json-ld :data="array_filter([
                '@context' => 'https://schema.org',
                '@type' => 'Service',
                'name' => $s->getTranslation('titlu', $loc) ?: $s->getTranslation('titlu', 'ro'),
                'description' => $s->getTranslation('descriere', $loc) ?: $s->getTranslation('descriere', 'ro'),
                'serviceType' => $s->categorie,
                'areaServed' => ['Prahova', 'Ilfov', 'Bucuresti'],
                'provider' => ['@type' => 'Organization', 'name' => 'Galle Silva SRL'],
            ], fn ($v) => $v !== null && $v !== '')" />
        @endforeach

        <x-json-ld :data="[
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Acasa', 'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Servicii', 'item' => url('/servicii')],
            ],
        ]" />
    @endpush

    <section class="bg-forest text-mist-warm py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-display text-4xl md:text-5xl font-semibold">Servicii</h1>
            <p class="mt-4 text-lg text-mist max-w-2xl mx-auto">Forestier, peisagistica, compostare — pentru primarii, institutii si companii.</p>
        </div>
    </section>

    <section class="py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <nav class="flex flex-wrap gap-2 mb-10 justify-center" aria-label="Categorii">
                <a href="/servicii" class="px-4 py-2 rounded-full text-sm {{ ! $activeCategorie ? 'bg-forest text-mist-warm' : 'bg-mist text-forest-dark hover:bg-mint hover:text-forest-dark' }}">Toate</a>
                <a href="/servicii/forestiere" class="px-4 py-2 rounded-full text-sm {{ $activeCategorie === 'forestiere' ? 'bg-forest text-mist-warm' : 'bg-mist text-forest-dark hover:bg-mint hover:text-forest-dark' }}">Forestiere</a>
                <a href="/servicii/peisagistica" class="px-4 py-2 rounded-full text-sm {{ $activeCategorie === 'peisagistica' ? 'bg-forest text-mist-warm' : 'bg-mist text-forest-dark hover:bg-mint hover:text-forest-dark' }}">Peisagistica</a>
                <a href="/servicii/compostare" class="px-4 py-2 rounded-full text-sm {{ $activeCategorie === 'compostare' ? 'bg-forest text-mist-warm' : 'bg-mist text-forest-dark hover:bg-mint hover:text-forest-dark' }}">Compostare</a>
            </nav>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($servicii as $serv)
                    <article class="bg-mist-warm rounded-2xl p-6">
                        <p class="text-xs uppercase tracking-widest text-mint font-medium mb-2">{{ $serv->categorie->label() }}</p>
                        <h2 class="font-display text-xl font-semibold mb-3">{{ $serv->getTranslation('titlu', 'ro') }}</h2>
                        <p class="text-sm text-forest-dark/80 mb-4">{{ $serv->getTranslation('descriere', 'ro') }}</p>
                        <p class="text-xs text-forest-dark/60">Audienta: <strong>{{ $serv->audienta->label() }}</strong></p>
                    </article>
                @empty
                    <p class="text-forest-dark/60 col-span-full text-center">Nu sunt servicii in aceasta categorie.</p>
                @endforelse
            </div>

            <div class="mt-12 text-center">
                <a href="/contact" class="inline-flex items-center rounded-full bg-forest px-6 py-3 text-mist-warm hover:bg-forest-dark font-medium">Cere oferta personalizata</a>
            </div>
        </div>
    </section>
</x-layouts.app>
