<section class="mx-auto max-w-7xl px-6 py-20 lg:py-28">
    <div class="text-center mb-12">
        <p class="text-sm uppercase tracking-[0.2em] text-forest/50">{{ __('Pentru cine') }}</p>
        <h2 class="mt-3 font-display text-3xl lg:text-4xl font-bold text-forest">
            {{ __('Doua flow-uri, o singura calitate germana') }}
        </h2>
    </div>

    <div class="grid md:grid-cols-2 gap-6 lg:gap-8">
        {{-- A: client privat --}}
        <a href="/lemn-de-foc"
           class="group relative overflow-hidden rounded-3xl bg-forest p-8 lg:p-10 text-mist hover:brightness-110 transition">
            <p class="text-mint text-xs uppercase tracking-[0.2em] font-semibold">{{ __('Sunt client privat') }}</p>
            <h3 class="mt-3 font-display text-2xl lg:text-3xl font-extrabold">{{ __('Lemn de foc') }}</h3>
            <p class="mt-4 text-mist/75 font-light max-w-sm">
                {{ __('Stejar disponibil acum. Fag si carpen — in curand. Pret in metri steri sau tone. Livrare in 2-5 zile.') }}
            </p>
            <span class="mt-8 inline-flex items-center justify-center size-11 rounded-full bg-mint text-forest group-hover:translate-x-1 transition-transform">→</span>
        </a>

        {{-- B: firma / institutie --}}
        <a href="/servicii"
           class="group relative overflow-hidden rounded-3xl bg-white border-2 border-forest p-8 lg:p-10 text-forest hover:border-mint transition">
            <p class="text-forest/50 text-xs uppercase tracking-[0.2em] font-semibold">{{ __('Sunt firma / institutie') }}</p>
            <h3 class="mt-3 font-display text-2xl lg:text-3xl font-extrabold">{{ __('Servicii dedicate') }}</h3>
            <p class="mt-4 text-forest/70 font-light max-w-sm">
                {{ __('Forestier, peisagistica, compostare — pentru primarii, institutii si companii. Plata la termen, factura.') }}
            </p>
            <span class="mt-8 inline-flex items-center justify-center size-11 rounded-full bg-forest text-mint group-hover:translate-x-1 transition-transform">→</span>
        </a>
    </div>
</section>
