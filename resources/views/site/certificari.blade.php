<x-layouts.app
    :title="__('Certificari — FSC, PEFC, ISO 9001/14001, RAL, DEKRA | Galle Silva')"
    :metaDescription="__('Certificarile Galle Silva si ale partenerului Galle GmbH: FSC si PEFC in proces, ISO 9001, ISO 14001, RAL si DEKRA active. Calitate validata.')"
>
    <section class="bg-forest text-mist-warm py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-display text-4xl md:text-5xl font-semibold">{{ __('Certificari') }}</h1>
            <p class="mt-4 text-lg text-mist max-w-2xl mx-auto">{{ __('FSC si PEFC — in proces. ISO 9001, ISO 14001, RAL si DEKRA — detinute de Galle GmbH, partenerul nostru german.') }}</p>
        </div>
    </section>

    <section class="py-16">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 grid md:grid-cols-2 gap-6">
            @foreach($certificari as $cert)
                <article class="bg-mist-warm rounded-2xl p-6">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <p class="text-xs uppercase tracking-widest text-mint font-medium mb-1">{{ $cert->tip->value }}</p>
                            <h2 class="font-display text-xl font-semibold">{{ $cert->nume }}</h2>
                        </div>
                        <span class="text-xs px-2 py-1 rounded-full {{ $cert->status->value === 'activ' ? 'bg-mint/20 text-forest-dark' : 'bg-amber-100 text-amber-800' }}">
                            {{ __($cert->status->label()) }}
                        </span>
                    </div>
                    @if($cert->emitent)
                        <p class="text-xs text-forest-dark/60 mb-2">{{ __('Emis de') }} <strong>{{ $cert->emitent }}</strong></p>
                    @endif
                    <p class="text-sm text-forest-dark/80">{{ $cert->getTranslation('descriere', app()->getLocale()) ?: $cert->getTranslation('descriere', 'ro') }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="bg-mist-warm py-16">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-mint uppercase tracking-widest text-xs font-medium mb-2">{{ __('Educational') }}</p>
            <h2 class="font-display text-2xl font-semibold mb-4">{{ __('De ce FSC / PEFC e mai important decat ISO pentru lemn?') }}</h2>
            <p class="text-forest-dark/80">
                {{ __('Certificarile FSC si PEFC verifica direct sursa lemnului — provenienta din paduri gestionate sustenabil si lantul de custodie pana la consumator. ISO 9001 / 14001 sunt despre proces si management organizational — utile, dar nu inlocuiesc trasabilitatea produsului.') }}
            </p>
        </div>
    </section>
</x-layouts.app>
