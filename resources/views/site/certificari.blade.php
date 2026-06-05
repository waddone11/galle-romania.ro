@php
    $loc = app()->getLocale();

    // Titlu + meta editabile din admin (Pagina[slug=certificari]), cu fallback hardcodat.
    $titlu = ($pagina?->getTranslation('titlu', $loc) ?: $pagina?->getTranslation('titlu', 'ro'))
        ?: __('Certificari');
    $metaTitle = ($pagina?->getTranslation('meta_title', $loc) ?: $pagina?->getTranslation('meta_title', 'ro'))
        ?: __('Certificari — FSC, PEFC, ISO 9001/14001, RAL, DEKRA | Galle Silva');
    $metaDesc = ($pagina?->getTranslation('meta_description', $loc) ?: $pagina?->getTranslation('meta_description', 'ro'))
        ?: __('Certificarile Galle Silva si ale partenerului Galle GmbH: FSC si PEFC in proces, ISO 9001, ISO 14001, RAL si DEKRA active. Calitate validata.');

    [$obtinute, $inProces] = $certificari->partition(
        fn ($cert) => $cert->status === \App\Enums\CertificareStatus::Activ
    );
@endphp
<x-layouts.app
    :title="$metaTitle"
    :metaDescription="$metaDesc"
>
    <section class="bg-forest text-mist-warm py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-display text-3xl md:text-5xl font-semibold text-balance break-words hyphens-auto">{{ $titlu }}</h1>
            <p class="mt-4 text-lg text-mist max-w-2xl mx-auto">{{ __('FSC si PEFC — in proces. ISO 9001, ISO 14001, RAL si DEKRA — detinute de Galle GmbH, partenerul nostru german.') }}</p>
        </div>
    </section>

    @if($obtinute->isNotEmpty())
        <section class="py-16 lg:py-20">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <p class="text-sm font-semibold uppercase tracking-[0.25em] text-forest/50">{{ __('Certificat') }}</p>
                    <h2 class="mt-3 font-display text-3xl font-semibold text-forest text-balance break-words hyphens-auto">{{ __('Certificari ale grupului Galle GmbH') }}</h2>
                </div>
                <div class="mt-10 grid gap-6 sm:grid-cols-2">
                    @foreach($obtinute as $cert)
                        <x-certificare-card :cert="$cert" variant="detail" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($inProces->isNotEmpty())
        <section class="bg-mist-warm py-16 lg:py-20">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <p class="text-sm font-semibold uppercase tracking-[0.25em] text-forest/50">{{ __('In curs de obtinere') }}</p>
                    <h2 class="mt-3 font-display text-3xl font-semibold text-forest text-balance break-words hyphens-auto">{{ __('In proces de certificare') }}</h2>
                </div>
                <div class="mt-10 grid gap-6 sm:grid-cols-2 max-w-3xl mx-auto">
                    @foreach($inProces as $cert)
                        <x-certificare-card :cert="$cert" variant="detail" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="py-16">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-mint uppercase tracking-widest text-xs font-medium mb-2">{{ __('Educational') }}</p>
            <h2 class="font-display text-2xl font-semibold mb-4 text-balance break-words hyphens-auto">{{ __('De ce FSC / PEFC e mai important decat ISO pentru lemn?') }}</h2>
            <p class="text-forest-dark/80">
                {{ __('Certificarile FSC si PEFC verifica direct sursa lemnului — provenienta din paduri gestionate sustenabil si lantul de custodie pana la consumator. ISO 9001 / 14001 sunt despre proces si management organizational — utile, dar nu inlocuiesc trasabilitatea produsului.') }}
            </p>
        </div>
    </section>
</x-layouts.app>
