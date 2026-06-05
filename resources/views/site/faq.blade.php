{{--
    Pagina dedicata FAQ (/intrebari-frecvente) — centru de ajutor.
    Controller-ul paseaza:
      - $pagina  — modelul Pagina slug `intrebari-frecvente` (titlu/meta/intro editabile; poate fi null)
      - $grupuri — Collection<categorie, Collection<Faq>> in ordinea din Faq::CATEGORII
      - $schemas — JSON-LD (FAQPage + breadcrumb)

    Design: hero forest + search flotant peste margine, rail sticky de categorii pe desktop
    (pills orizontale pe mobil), carduri acordeon cu animatie pe grid-template-rows,
    filtru live cu normalizare diacritice, empty state si CTA banner spre contact.
--}}
@php
    $loc = app()->getLocale();
    $prefix = $loc === 'ro' ? '' : '/'.$loc;

    $metaTitle = ($pagina?->getTranslation('meta_title', $loc) ?: $pagina?->getTranslation('meta_title', 'ro'))
        ?: __('Intrebari frecvente').' | Galle Silva';
    $metaDesc = $pagina?->getTranslation('meta_description', $loc) ?: $pagina?->getTranslation('meta_description', 'ro');

    // Titlu + intro editabile din CMS (blocul header_pagina al paginii), cu fallback static.
    $header = collect($pagina?->sectiuni ?? [])
        ->first(fn ($b) => is_array($b) && ($b['type'] ?? null) === 'header_pagina');
    $titlu = $header['data']['titlu'][$loc] ?? $header['data']['titlu']['ro'] ?? __('Intrebari frecvente');
    $intro = $header['data']['intro'][$loc] ?? $header['data']['intro']['ro']
        ?? __('Raspunsuri despre lemn de foc, servicii forestiere, livrare si documente.');

    $total = $grupuri->flatten(1)->count();

    // Icon per categorie (x-galle-icon) — coerent cu restul site-ului.
    $icoane = [
        'lemn-de-foc' => 'flacara',
        'livrare' => 'camion',
        'plata' => 'card',
        'exploatare-forestiera' => 'copaci',
        'achizitie-masa-lemnoasa' => 'handshake',
        'curatare-terenuri' => 'excavator',
        'transport-lemn' => 'forwarder',
        'lucrari-silvice' => 'frunza',
        'servicii' => 'topor',
        'general' => 'intrebare',
    ];
    $eticheta = fn (string $cat) => __(\App\Models\Faq::CATEGORII[$cat] ?? \Illuminate\Support\Str::headline($cat));
@endphp
<x-layouts.app :title="$metaTitle" :metaDescription="$metaDesc">
    @push('seo')
        @foreach($schemas ?? [] as $schema)
            <x-json-ld :data="$schema" />
        @endforeach
    @endpush

    <div
        x-data="{
            q: '',
            vizibile: {{ $total }},
            activa: '',
            norm(s) { return s.toLowerCase().normalize('NFD').replace(/[̀-ͯ]/g, '').trim() },
            match(el) { return this.norm(this.q) === '' || el.dataset.text.includes(this.norm(this.q)) },
            catVizibila(el) { return this.norm(this.q) === '' || Array.from(el.querySelectorAll('[data-faq-card]')).some(c => this.match(c)) },
            numara() { this.vizibile = Array.from(this.$root.querySelectorAll('[data-faq-card]')).filter(el => this.match(el)).length },
            mergi(id) {
                document.getElementById(id)?.scrollIntoView({
                    behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth',
                    block: 'start',
                });
            },
            init() {
                this.$watch('q', () => this.numara());
                // Scroll-spy: categoria din viewport evidentiata in rail/pills.
                const obs = new IntersectionObserver((entries) => {
                    entries.forEach(e => { if (e.isIntersecting) this.activa = e.target.id });
                }, { rootMargin: '-25% 0px -65% 0px' });
                this.$root.querySelectorAll('[data-faq-categorie]').forEach(s => obs.observe(s));
            },
        }"
    >
        {{-- Hero forest cu aer; search-ul flotant se suprapune pe marginea de jos --}}
        <section class="bg-forest text-mist-warm pt-16 pb-20 lg:pt-20 lg:pb-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="font-display text-3xl md:text-5xl font-semibold text-balance break-words hyphens-auto">{{ $titlu }}</h1>
                <p class="mt-4 text-lg text-mist max-w-2xl mx-auto">{{ $intro }}</p>
            </div>
        </section>

        <section class="bg-mist-warm pb-14 lg:pb-20">
            {{-- Search box mare, flotant peste banda forest --}}
            <div class="relative z-10 -mt-7 px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-2xl">
                    <label for="faq-cauta" class="sr-only">{{ __('Cauta o intrebare...') }}</label>
                    <div class="relative">
                        <svg class="pointer-events-none absolute left-5 top-1/2 h-5 w-5 -translate-y-1/2 text-forest/40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>
                        </svg>
                        <input
                            id="faq-cauta"
                            type="search"
                            x-model="q"
                            placeholder="{{ __('Cauta o intrebare...') }}"
                            class="w-full rounded-full bg-white py-4 pl-12 pr-6 text-base text-forest shadow-lg shadow-forest/10 ring-1 ring-forest/10 placeholder:text-forest/40 focus:outline-none focus:ring-2 focus:ring-mint"
                        >
                    </div>
                    {{-- Contor live: „X intrebari" / „X rezultate" la cautare --}}
                    <p class="mt-3 text-center text-sm text-forest-dark/60" aria-live="polite">
                        <span x-text="vizibile">{{ $total }}</span>
                        <span x-text="norm(q) === ''
                            ? (vizibile === 1 ? '{{ __('intrebare') }}' : '{{ __('intrebari') }}')
                            : (vizibile === 1 ? '{{ __('rezultat') }}' : '{{ __('rezultate') }}')">{{ __('intrebari') }}</span>
                    </p>
                </div>
            </div>

            <div class="mx-auto mt-8 max-w-7xl px-4 sm:px-6 lg:px-8 lg:mt-10 lg:grid lg:grid-cols-12 lg:gap-10 lg:items-start">
                {{-- Rail sticky de categorii (desktop) --}}
                <aside class="hidden lg:block lg:col-span-4">
                    <nav class="sticky top-24 space-y-1.5" aria-label="{{ __('Categorii de intrebari') }}">
                        @foreach($grupuri as $categorie => $faqs)
                            <a href="#cat-{{ $categorie }}"
                               @click.prevent="mergi('cat-{{ $categorie }}')"
                               :class="activa === 'cat-{{ $categorie }}' ? 'bg-mint/15 text-forest ring-1 ring-mint/40' : 'text-forest-dark/70 hover:bg-white hover:text-forest'"
                               class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition">
                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-mint/15 text-forest">
                                    <x-galle-icon :icon="$icoane[$categorie] ?? 'frunza'" :size="18" />
                                </span>
                                <span class="flex-1">{{ $eticheta($categorie) }}</span>
                                <span class="rounded-full bg-forest/5 px-2.5 py-0.5 text-xs font-semibold text-forest-dark/60">{{ $faqs->count() }}</span>
                            </a>
                        @endforeach
                    </nav>
                </aside>

                {{-- Pills orizontale scrollabile (mobil), sticky sub navbar (h-16) --}}
                <div class="lg:hidden sticky top-16 z-20 -mx-4 mb-6 border-b border-forest/5 bg-mist-warm/95 px-4 py-3 backdrop-blur">
                    <div class="flex snap-x gap-2 overflow-x-auto no-scrollbar" role="navigation" aria-label="{{ __('Categorii de intrebari') }}">
                        @foreach($grupuri as $categorie => $faqs)
                            <a href="#cat-{{ $categorie }}"
                               @click.prevent="mergi('cat-{{ $categorie }}')"
                               :class="activa === 'cat-{{ $categorie }}' ? 'bg-mint text-forest ring-mint' : 'bg-white text-forest-dark/70 ring-forest/10'"
                               class="inline-flex shrink-0 snap-start items-center gap-1.5 rounded-full px-4 py-2 text-xs font-medium ring-1 transition">
                                {{ $eticheta($categorie) }}
                                <span class="text-[10px] opacity-60">{{ $faqs->count() }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Coloana cu sectiunile de categorie --}}
                <div class="lg:col-span-8">
                    {{-- Deschide/Inchide toate (ascuns in timpul cautarii) --}}
                    <div class="mb-5 flex items-center justify-end gap-3 text-sm font-medium text-forest-dark/60" x-show="norm(q) === ''">
                        <button type="button" @click="$dispatch('faq-toate', true)" class="transition hover:text-forest">{{ __('Deschide toate') }}</button>
                        <span class="text-forest/20" aria-hidden="true">·</span>
                        <button type="button" @click="$dispatch('faq-toate', false)" class="transition hover:text-forest">{{ __('Inchide toate') }}</button>
                    </div>

                    @foreach($grupuri as $categorie => $faqs)
                        <section
                            id="cat-{{ $categorie }}"
                            data-faq-categorie
                            x-show="catVizibila($el)"
                            class="scroll-mt-36 lg:scroll-mt-28 {{ $loop->first ? '' : 'mt-12' }}"
                        >
                            <div class="flex items-center gap-3">
                                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-mint/15 text-forest">
                                    <x-galle-icon :icon="$icoane[$categorie] ?? 'frunza'" :size="20" />
                                </span>
                                <h2 class="font-display text-2xl font-semibold text-forest text-balance break-words hyphens-auto">{{ $eticheta($categorie) }}</h2>
                                <span class="text-sm text-forest-dark/50">{{ $faqs->count() }} {{ $faqs->count() === 1 ? __('intrebare') : __('intrebari') }}</span>
                            </div>

                            <div class="mt-5 space-y-3">
                                @foreach($faqs as $faq)
                                    @php
                                        $intrebare = $faq->getTranslation('intrebare', $loc) ?: $faq->getTranslation('intrebare', 'ro');
                                        $raspuns = $faq->getTranslation('raspuns', $loc) ?: $faq->getTranslation('raspuns', 'ro');
                                        $idRaspuns = 'faq-raspuns-'.$faq->id;
                                    @endphp
                                    <article
                                        x-data="{ open: false }"
                                        @faq-toate.window="open = $event.detail"
                                        data-faq-card
                                        data-text="{{ \Illuminate\Support\Str::lower(\Illuminate\Support\Str::ascii($intrebare.' '.$raspuns)) }}"
                                        x-show="match($el)"
                                        class="group rounded-2xl border-l-2 bg-white shadow-sm ring-1 transition motion-safe:hover:-translate-y-0.5 hover:shadow-md"
                                        :class="open ? 'border-mint ring-mint/30' : 'border-transparent ring-forest/10'"
                                    >
                                        <h3>
                                            <button
                                                type="button"
                                                @click="open = !open"
                                                aria-expanded="false"
                                                :aria-expanded="open.toString()"
                                                aria-controls="{{ $idRaspuns }}"
                                                class="flex w-full items-center justify-between gap-4 px-5 py-4 text-left sm:px-6 sm:py-5"
                                            >
                                                <span class="font-medium text-forest">{{ $intrebare }}</span>
                                                <span
                                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full transition motion-safe:duration-300"
                                                    :class="open ? 'bg-mint text-white motion-safe:rotate-180' : 'bg-mint/15 text-forest'"
                                                >
                                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                        <path d="m6 9 6 6 6-6"/>
                                                    </svg>
                                                </span>
                                            </button>
                                        </h3>
                                        {{-- Dezvaluire lina: animatie pe grid-template-rows (fara plugin) --}}
                                        <div
                                            id="{{ $idRaspuns }}"
                                            class="grid grid-rows-[0fr] motion-safe:transition-[grid-template-rows] motion-safe:duration-300 motion-safe:ease-out"
                                            :class="open ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]'"
                                        >
                                            <div class="overflow-hidden">
                                                <p class="px-5 pb-5 text-sm leading-relaxed text-forest-dark/75 sm:px-6 sm:pb-6">{{ $raspuns }}</p>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </section>
                    @endforeach

                    {{-- Empty state la cautare fara rezultate --}}
                    <div x-show="norm(q) !== '' && vizibile === 0" x-cloak class="rounded-3xl bg-white px-6 py-16 text-center ring-1 ring-forest/10">
                        <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-mist-warm text-forest/40">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>
                            </svg>
                        </span>
                        <p class="mt-4 font-medium text-forest">{{ __('Nu am gasit nicio intrebare pentru') }} &bdquo;<span x-text="q"></span>&rdquo;</p>
                        <div class="mt-6 flex flex-wrap justify-center gap-3">
                            <button type="button" @click="q = ''" class="rounded-full bg-forest px-5 py-2.5 text-sm font-semibold text-mist-warm transition hover:bg-forest-dark">{{ __('Sterge cautarea') }}</button>
                            <a href="{{ $prefix }}/contact" class="rounded-full bg-mint/15 px-5 py-2.5 text-sm font-semibold text-forest ring-1 ring-mint/40 transition hover:bg-mint/25">{{ __('Scrie-ne') }}</a>
                        </div>
                    </div>

                    {{-- CTA final spre contact --}}
                    <div class="mt-14 rounded-3xl bg-forest px-6 py-10 text-center sm:flex sm:items-center sm:justify-between sm:gap-8 sm:px-10 sm:text-left">
                        <div>
                            <p class="font-display text-2xl font-semibold text-mist-warm">{{ __('Nu ai gasit raspunsul?') }}</p>
                            <p class="mt-2 text-sm text-mist/80">{{ __('Scrie-ne si te contactam in 24h.') }}</p>
                        </div>
                        <div class="mt-6 flex shrink-0 flex-wrap justify-center gap-3 sm:mt-0">
                            <a href="{{ $prefix }}/contact" class="rounded-full bg-mint px-6 py-3 text-sm font-semibold text-forest transition hover:brightness-105">{{ __('Scrie-ne') }}</a>
                            <a href="{{ $prefix }}/contact" class="rounded-full px-6 py-3 text-sm font-semibold text-mist-warm ring-1 ring-mist/30 transition hover:bg-white/5">{{ __('Cere oferta') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-layouts.app>
