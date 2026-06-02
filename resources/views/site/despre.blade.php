<x-layouts.app>
    <section class="bg-forest text-mist-warm py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-display text-4xl md:text-5xl font-semibold">Despre Galle Silva</h1>
            <p class="mt-4 text-lg text-mist max-w-2xl mx-auto">
                Partener local Galle GmbH Germania. Aducem standarde germane in gestiunea padurii din Romania.
            </p>
        </div>
    </section>

    <section class="py-16">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 space-y-12">
            <div>
                <p class="text-mint uppercase tracking-widest text-xs font-medium mb-2">Pasul 1</p>
                <h2 class="font-display text-2xl font-semibold mb-3">Galle Silva — operatiunea locala</h2>
                <p class="text-forest-dark/80">
                    Galle Silva SRL este entitatea juridica din Romania care opereaza pe segmentele de lemn de foc, servicii forestiere, peisagistica si compostare in zonele Prahova, Ilfov si Bucuresti.
                </p>
            </div>
            <div>
                <p class="text-mint uppercase tracking-widest text-xs font-medium mb-2">Pasul 2</p>
                <h2 class="font-display text-2xl font-semibold mb-3">Galle GmbH — partenerul german</h2>
                <p class="text-forest-dark/80">
                    Galle GmbH gestioneaza paduri si livreaza materiale lemnoase in Germania de peste 30 de ani. Detine certificari ISO 9001, ISO 14001, RAL si DEKRA — standardele care definesc calitatea germana in industrie.
                </p>
            </div>
            <div>
                <p class="text-mint uppercase tracking-widest text-xs font-medium mb-2">Pasul 3</p>
                <h2 class="font-display text-2xl font-semibold mb-3">Parteneriatul</h2>
                <p class="text-forest-dark/80">
                    Galle Silva aplica integral procedurile, controalele si principiile Galle GmbH pe operatiunile sale din Romania. Suntem in proces de certificare FSC si PEFC pentru a aduce trasabilitate completa si in piata locala.
                </p>
            </div>
        </div>
    </section>

    @if($certificari->count() > 0)
        <section class="bg-mist-warm py-16">
            <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="font-display text-2xl font-semibold mb-8">Standarde si certificari</h2>
                <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($certificari as $cert)
                        <div class="bg-[#fafaf8] rounded-xl p-4 text-left">
                            <p class="text-xs uppercase tracking-widest text-mint font-medium mb-1">{{ $cert->tip->value }}</p>
                            <h3 class="font-semibold text-sm mb-1">{{ $cert->nume }}</h3>
                            <span class="text-xs px-2 py-0.5 rounded-full {{ $cert->status->value === 'activ' ? 'bg-mint/20 text-forest-dark' : 'bg-amber-100 text-amber-800' }}">
                                {{ $cert->status->label() }}
                            </span>
                        </div>
                    @endforeach
                </div>
                <a href="/certificari" class="inline-block mt-6 text-forest font-semibold hover:text-mint">Vezi toate certificarile →</a>
            </div>
        </section>
    @endif
</x-layouts.app>
