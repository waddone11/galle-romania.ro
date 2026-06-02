<x-layouts.app>
    {{-- Hero — full structural rebuild in §11 (clouds, wheel chips, conic badge).
         For now: tokens + typography + CTA wired correctly. --}}
    <section class="relative isolate overflow-hidden bg-gradient-to-b from-mist-warm to-[#fafaf8]">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20 lg:py-32 grid lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7">
                <div class="inline-flex items-center gap-2 rounded-full bg-forest/5 px-4 py-1.5 mb-6">
                    <span class="size-2 rounded-full bg-mint animate-pulse"></span>
                    <span class="text-xs uppercase tracking-widest text-forest font-medium">
                        Partener local Galle GmbH Germania
                    </span>
                </div>

                <h1 class="font-display text-5xl md:text-6xl lg:text-7xl font-semibold text-forest-dark leading-[1.05]">
                    Padurea, <br>
                    <span class="text-forest">gestionata cu</span><br>
                    <span class="text-mint">responsabilitate</span>
                </h1>

                <p class="mt-6 text-lg text-forest-dark/80 max-w-xl">
                    Lemn de foc din stejar, servicii forestiere, peisagistica si compostare —
                    livrate in Prahova, Ilfov si Bucuresti.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="/lemn-de-foc"
                       class="inline-flex items-center rounded-full bg-forest px-6 py-3 text-mist-warm hover:bg-forest-dark transition-colors font-medium">
                        Comanda lemn de foc
                    </a>
                    <a href="/servicii"
                       class="inline-flex items-center rounded-full border-2 border-forest px-6 py-3 text-forest hover:bg-forest hover:text-mist-warm transition-colors font-medium">
                        Servicii pentru firme si institutii
                    </a>
                </div>
            </div>

            {{-- Wheel placeholder — full animated SVG with chips in §11 --}}
            <div class="lg:col-span-5 hidden lg:flex items-center justify-center relative h-[420px]">
                <div class="absolute inset-0 m-auto size-80 rounded-full border-2 border-mint/40 wheel-orbit">
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 wheel-chip bg-mint text-forest-dark text-xs font-medium px-3 py-1.5 rounded-full shadow-md">Stejar</div>
                    <div class="absolute top-1/2 -right-3 -translate-y-1/2 wheel-chip bg-forest text-mint text-xs font-medium px-3 py-1.5 rounded-full shadow-md">Forestier</div>
                    <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 wheel-chip bg-mist-warm border border-forest/20 text-forest-dark text-xs font-medium px-3 py-1.5 rounded-full shadow-md">Compost</div>
                    <div class="absolute top-1/2 -left-3 -translate-y-1/2 wheel-chip bg-mint-soft text-forest-dark text-xs font-medium px-3 py-1.5 rounded-full shadow-md">Peisagistica</div>
                </div>
                <div class="absolute inset-0 m-auto size-56 rounded-full badge-pill-conic opacity-30 blur-2xl"></div>
                <div class="relative z-10 size-40 rounded-full bg-forest text-mist-warm flex items-center justify-center font-display text-3xl font-semibold">
                    G<span class="text-mint">S</span>
                </div>
            </div>
        </div>

        {{-- Cloud layers — purely decorative --}}
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 -z-10">
            <div class="cloud-anim absolute top-12 left-1/4 size-24 rounded-full bg-mist blur-2xl"></div>
            <div class="cloud-anim delay-2 absolute top-40 right-1/4 size-32 rounded-full bg-mist blur-2xl"></div>
            <div class="cloud-anim delay-3 absolute top-72 left-1/2 size-28 rounded-full bg-mist blur-2xl"></div>
            <div class="cloud-anim delay-4 absolute top-20 right-1/2 size-20 rounded-full bg-mist blur-2xl"></div>
        </div>
    </section>

    {{-- Audience splitter placeholder — Livewire version in §11 --}}
    <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-12">
            <h2 class="font-display text-3xl md:text-4xl font-semibold">Pentru cine lucram?</h2>
            <p class="mt-3 text-forest-dark/70">Doua flow-uri, o singura calitate germana.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <a href="/lemn-de-foc"
               class="group relative overflow-hidden rounded-2xl bg-forest p-8 text-mist-warm hover:scale-[1.02] transition-transform">
                <div class="text-mint text-sm uppercase tracking-widest mb-3">Client privat</div>
                <h3 class="font-display text-2xl mb-3">Lemn de foc</h3>
                <p class="text-mist-warm/80">Stejar disponibil acum. Fag si carpen — in curand. Pret in metri steri sau tone.</p>
                <span class="absolute bottom-6 right-6 size-10 rounded-full bg-mint text-forest-dark flex items-center justify-center group-hover:translate-x-1 transition-transform">→</span>
            </a>

            <a href="/servicii"
               class="group relative overflow-hidden rounded-2xl bg-mist-warm border-2 border-forest p-8 text-forest hover:scale-[1.02] transition-transform">
                <div class="text-forest/60 text-sm uppercase tracking-widest mb-3">Firma / institutie</div>
                <h3 class="font-display text-2xl mb-3">Servicii</h3>
                <p class="text-forest-dark/80">Forestier, peisagistica, compostare — pentru primarii, institutii si companii.</p>
                <span class="absolute bottom-6 right-6 size-10 rounded-full bg-forest text-mint flex items-center justify-center group-hover:translate-x-1 transition-transform">→</span>
            </a>
        </div>
    </section>

    {{-- Solutia noastra verde — SVG dome line-art --}}
    <section class="bg-mist-warm py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-mint uppercase tracking-widest text-xs font-medium mb-3">Solutia noastra verde</p>
                <h2 class="font-display text-3xl md:text-4xl font-semibold mb-4">Padurea ca sistem viu, nu ca depozit.</h2>
                <p class="text-forest-dark/80">
                    Gestionam fiecare parcela astfel incat productia de azi sa nu sacrifice regenerarea de maine.
                    Documentam, monitorizam si rotim recoltarile — pe baza standardelor germane Galle GmbH.
                </p>
            </div>
            <svg viewBox="0 0 400 300" class="w-full h-auto" aria-hidden="true">
                <g fill="none" stroke="currentColor" stroke-width="1.5" class="text-forest dome-stroke">
                    <path d="M50,250 Q200,80 350,250"/>
                    <line x1="80" y1="220" x2="80" y2="250"/>
                    <line x1="140" y1="160" x2="140" y2="250"/>
                    <line x1="200" y1="100" x2="200" y2="250"/>
                    <line x1="260" y1="160" x2="260" y2="250"/>
                    <line x1="320" y1="220" x2="320" y2="250"/>
                </g>
            </svg>
        </div>
    </section>

    {{-- Resursa regenerabila — 3 recycling arrows on arc --}}
    <section class="py-20 mx-auto max-w-4xl text-center px-4">
        <div class="relative mx-auto size-40 mb-6">
            <svg viewBox="0 0 100 100" class="size-full text-mint">
                <g fill="currentColor">
                    <path class="recycle-arrow" d="M50,10 L60,25 L55,25 L55,40 L45,40 L45,25 L40,25 Z"/>
                    <path class="recycle-arrow arr-2" d="M85,55 L70,65 L70,60 L55,60 L55,50 L70,50 L70,45 Z"/>
                    <path class="recycle-arrow arr-3" d="M50,90 L40,75 L45,75 L45,60 L55,60 L55,75 L60,75 Z" transform="rotate(180 50 75)"/>
                </g>
            </svg>
        </div>
        <h2 class="font-display text-3xl md:text-4xl font-semibold mb-3">Lemnul — singura resursa regenerabila la scara.</h2>
        <p class="text-forest-dark/80 max-w-2xl mx-auto">
            Daca este recoltat responsabil, lemnul devine combustibil neutru in carbon — pentru ca padurea ramane padure.
        </p>
    </section>
</x-layouts.app>
