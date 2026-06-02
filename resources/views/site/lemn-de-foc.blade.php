<x-layouts.app>
    <section class="bg-forest text-mist-warm py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-display text-4xl md:text-5xl font-semibold">Lemn de foc</h1>
            <p class="mt-4 text-lg text-mist max-w-2xl mx-auto">
                Stejar uscat disponibil acum. Fag si carpen — in curand. Livrare in Prahova, Ilfov si Bucuresti.
            </p>
        </div>
    </section>

    {{-- Specii --}}
    <section class="py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid md:grid-cols-3 gap-6">
            @foreach($species as $sp)
                <div class="bg-mist-warm rounded-2xl p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="font-display text-xl font-semibold">{{ $sp->getTranslation('nume', 'ro') }}</h3>
                        <span class="text-xs px-2 py-1 rounded-full {{ $sp->status->value === 'disponibil' ? 'bg-mint/20 text-forest-dark' : 'bg-amber-100 text-amber-800' }}">
                            {{ $sp->status->label() }}
                        </span>
                    </div>
                    <p class="text-sm text-forest-dark/80 mb-4">{{ $sp->getTranslation('descriere', 'ro') }}</p>
                    <dl class="grid grid-cols-2 gap-2 text-sm pt-4 border-t border-forest/10">
                        <div>
                            <dt class="text-forest-dark/60 text-xs">Pret pornire</dt>
                            <dd class="font-semibold">{{ number_format($sp->pret_pornire, 0) }} lei</dd>
                        </div>
                        <div>
                            <dt class="text-forest-dark/60 text-xs">Putere calorica</dt>
                            <dd class="font-semibold">{{ $sp->putere_calorica }} kWh/kg</dd>
                        </div>
                    </dl>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Calculator + Order form --}}
    <section class="bg-mist-warm py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12">
            <div>
                <h2 class="font-display text-3xl font-semibold mb-3">Calculator pret</h2>
                <p class="text-forest-dark/70 mb-6">Estimam in timp real costul total. Comanda direct sau pe WhatsApp.</p>
                <livewire:firewood.price-calculator />
            </div>
            <div>
                <h2 class="font-display text-3xl font-semibold mb-3">Comanda lemn</h2>
                <p class="text-forest-dark/70 mb-6">Trimite-ne datele tale si te contactam in cel mult 24h pentru confirmare.</p>
                <livewire:firewood.order-form />
            </div>
        </div>
    </section>

    {{-- Zone livrare --}}
    <section class="py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="font-display text-3xl font-semibold mb-8 text-center">Unde livram</h2>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($zone as $z)
                    <div class="bg-[#fafaf8] border border-mist rounded-2xl p-6">
                        <h3 class="font-display text-xl font-semibold text-forest mb-2">{{ $z->judet }}</h3>
                        <p class="text-sm text-forest-dark/70 mb-3">Cost livrare: <strong>{{ number_format($z->cost_livrare, 0) }} lei</strong></p>
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
                <h2 class="font-display text-3xl font-semibold mb-8 text-center">Intrebari frecvente</h2>
                <div class="space-y-4">
                    @foreach($faqs as $faq)
                        <details class="bg-[#fafaf8] rounded-xl p-4 group">
                            <summary class="font-medium cursor-pointer flex justify-between items-center">
                                <span>{{ $faq->getTranslation('intrebare', 'ro') }}</span>
                                <span class="text-mint group-open:rotate-180 transition-transform">▾</span>
                            </summary>
                            <p class="mt-3 text-sm text-forest-dark/80">{{ $faq->getTranslation('raspuns', 'ro') }}</p>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.app>
