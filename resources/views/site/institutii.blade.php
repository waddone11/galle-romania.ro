<x-layouts.app>
    <section class="bg-forest text-mist-warm py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-display text-4xl md:text-5xl font-semibold">
                @if($pagina)
                    {{ $pagina->getTranslation('titlu', 'ro') }}
                @else
                    Pentru institutii si primarii
                @endif
            </h1>
            <p class="mt-4 text-lg text-mist max-w-2xl mx-auto">
                Servicii forestiere, peisagistica si compostare — disponibile cu factura si plata la termen pentru primarii, institutii si companii.
            </p>
        </div>
    </section>

    <section class="py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="font-display text-3xl font-semibold mb-8 text-center">Servicii dedicate</h2>
            <div class="grid md:grid-cols-3 gap-6 mb-12">
                @foreach($servicii as $serv)
                    <article class="bg-mist-warm rounded-2xl p-6">
                        <p class="text-xs uppercase tracking-widest text-mint font-medium mb-2">{{ $serv->categorie->label() }}</p>
                        <h3 class="font-display text-xl font-semibold mb-3">{{ $serv->getTranslation('titlu', 'ro') }}</h3>
                        <p class="text-sm text-forest-dark/80">{{ $serv->getTranslation('descriere', 'ro') }}</p>
                    </article>
                @endforeach
            </div>
            <div class="bg-forest text-mist-warm rounded-2xl p-8 text-center">
                <h3 class="font-display text-2xl mb-3">Lucrati la primarie sau institutie publica?</h3>
                <p class="mb-6 text-mist">Emitam factura cu plata la termen. Putem participa la achizitii directe sau proceduri SEAP.</p>
                <a href="/contact" class="inline-flex items-center rounded-full bg-mint px-6 py-3 text-forest-dark font-medium hover:scale-105 transition-transform">Cere oferta institutionala</a>
            </div>
        </div>
    </section>
</x-layouts.app>
