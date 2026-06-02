<x-layouts.app>
    {{-- Hero --}}
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
                    Lemn de foc, servicii forestiere, peisagistica si compostare — livrate in Prahova, Ilfov si Bucuresti dupa standardele germane.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="/lemn-de-foc" class="inline-flex items-center rounded-full bg-forest px-6 py-3 text-mist-warm hover:bg-forest-dark transition-colors font-medium">
                        Comanda lemn de foc
                    </a>
                    <a href="/servicii" class="inline-flex items-center rounded-full border-2 border-forest px-6 py-3 text-forest hover:bg-forest hover:text-mist-warm transition-colors font-medium">
                        Servicii pentru firme si institutii
                    </a>
                </div>
            </div>

            <div class="lg:col-span-5 hidden lg:flex items-center justify-center relative h-[420px]">
                <div class="absolute inset-0 m-auto size-80 rounded-full border-2 border-mint/40 wheel-orbit">
                    @foreach($species as $i => $sp)
                        @php
                            $positions = [
                                ['-top-3 left-1/2 -translate-x-1/2', 'bg-mint text-forest-dark'],
                                ['top-1/2 -right-3 -translate-y-1/2', 'bg-forest text-mint'],
                                ['-bottom-3 left-1/2 -translate-x-1/2', 'bg-mist-warm border border-forest/20 text-forest-dark'],
                                ['top-1/2 -left-3 -translate-y-1/2', 'bg-mint-soft text-forest-dark'],
                            ];
                            $pos = $positions[$i % 4];
                        @endphp
                        <div class="absolute {{ $pos[0] }} wheel-chip {{ $pos[1] }} text-xs font-medium px-3 py-1.5 rounded-full shadow-md">
                            {{ $sp->getTranslation('nume', 'ro') }}
                        </div>
                    @endforeach
                </div>
                <div class="absolute inset-0 m-auto size-56 rounded-full badge-pill-conic opacity-30 blur-2xl"></div>
                <div class="relative z-10 size-40 rounded-full bg-forest text-mist-warm flex items-center justify-center font-display text-3xl font-semibold">
                    G<span class="text-mint">S</span>
                </div>
            </div>
        </div>

        <div aria-hidden="true" class="pointer-events-none absolute inset-0 -z-10">
            <div class="cloud-anim absolute top-12 left-1/4 size-24 rounded-full bg-mist blur-2xl"></div>
            <div class="cloud-anim delay-2 absolute top-40 right-1/4 size-32 rounded-full bg-mist blur-2xl"></div>
            <div class="cloud-anim delay-3 absolute top-72 left-1/2 size-28 rounded-full bg-mist blur-2xl"></div>
        </div>
    </section>

    {{-- Splitter --}}
    <livewire:audience-splitter />

    {{-- Specii preview --}}
    <section class="bg-mist-warm py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <p class="text-mint text-xs uppercase tracking-widest font-medium mb-2">Catalog</p>
                <h2 class="font-display text-3xl md:text-4xl font-semibold">Lemn de foc — calitate germana</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($species as $sp)
                    <div class="bg-[#fafaf8] rounded-2xl p-6 border border-mist hover:border-mint transition-colors">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="font-display text-xl font-semibold">{{ $sp->getTranslation('nume', 'ro') }}</h3>
                            <span class="text-xs px-2 py-1 rounded-full {{ $sp->status->value === 'disponibil' ? 'bg-mint/20 text-forest-dark' : 'bg-amber-100 text-amber-800' }}">
                                {{ $sp->status->label() }}
                            </span>
                        </div>
                        <p class="text-sm text-forest-dark/70 line-clamp-3 mb-4">{{ $sp->getTranslation('descriere', 'ro') }}</p>
                        <div class="flex justify-between items-center pt-4 border-t border-mist">
                            <span class="text-forest font-semibold">de la {{ number_format($sp->pret_pornire, 0) }} lei / {{ $sp->unitate->label() }}</span>
                            <a href="/lemn-de-foc" class="text-sm text-mint hover:text-forest">Comanda →</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Solutia verde --}}
    <section class="py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-mint uppercase tracking-widest text-xs font-medium mb-3">Solutia noastra verde</p>
                <h2 class="font-display text-3xl md:text-4xl font-semibold mb-4">Padurea ca sistem viu, nu ca depozit.</h2>
                <p class="text-forest-dark/80 mb-6">
                    Gestionam fiecare parcela astfel incat productia de azi sa nu sacrifice regenerarea de maine. Documentam, monitorizam si rotim recoltarile dupa standardele germane Galle GmbH.
                </p>
                <a href="/despre" class="text-forest font-semibold hover:text-mint">Despre Galle Silva →</a>
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

    {{-- Servicii preview --}}
    <section class="bg-mist-warm py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <p class="text-mint text-xs uppercase tracking-widest font-medium mb-2">Servicii</p>
                <h2 class="font-display text-3xl md:text-4xl font-semibold">Pentru firme si institutii</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($servicii as $serv)
                    <a href="/servicii/{{ str_replace('servicii-', '', $serv->slug) }}" class="bg-[#fafaf8] rounded-2xl p-6 border border-mist hover:border-mint group">
                        <h3 class="font-display text-xl font-semibold mb-2 group-hover:text-mint">{{ $serv->getTranslation('titlu', 'ro') }}</h3>
                        <p class="text-sm text-forest-dark/70 line-clamp-3">{{ $serv->getTranslation('descriere', 'ro') }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CMS-driven blocks: any extra content from Pagina[slug=home].sectiuni
         is rendered before the blog preview. Editable via /admin Pagina Builder. --}}
    @if($pagina && is_array($pagina->sectiuni))
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

    {{-- Articole recente --}}
    @if($articole->count() > 0)
        <section class="py-20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-end mb-12">
                    <h2 class="font-display text-3xl md:text-4xl font-semibold">Din blog</h2>
                    <a href="/blog" class="text-mint hover:text-forest">Toate articolele →</a>
                </div>
                <div class="grid md:grid-cols-3 gap-6">
                    @foreach($articole as $art)
                        <a href="/blog/{{ $art->slug }}" class="block group">
                            <div class="aspect-video rounded-xl bg-forest/10 mb-3"></div>
                            <p class="text-xs text-mint uppercase tracking-widest mb-1">{{ $art->categorie }}</p>
                            <h3 class="font-display text-lg font-semibold group-hover:text-mint">{{ $art->getTranslation('titlu', 'ro') }}</h3>
                            <p class="text-sm text-forest-dark/70 mt-2 line-clamp-2">{{ $art->getTranslation('excerpt', 'ro') }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.app>
