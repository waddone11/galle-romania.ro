@php
    $loc = app()->getLocale();
    $titlu = $pagina?->getTranslation('titlu', $loc) ?: ($pagina?->getTranslation('titlu', 'ro') ?: __('Date firma / Impressum'));
    $meta = $pagina?->getTranslation('meta_description', $loc) ?: null;

    /* Datele legale vin centralizat din config/company.php (override din .env). */
    $company = config('company');
    $codFiscal = $company['tva'] ? 'RO'.$company['cui'] : $company['cui'];
    $adresaCompleta = implode(', ', array_filter([
        $company['adresa'],
        $company['localitate'],
        'jud. '.$company['judet'],
        $company['cod_postal'],
        $company['tara'],
    ]));
@endphp
<x-layouts.app
    :title="$titlu.' | Galle Silva'"
    :metaDescription="$meta"
>
    {{-- Impressum (cerinta DSGVO/TMG pentru owner german): datele de identificare ale firmei. --}}
    <article class="py-16">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <h1 class="font-display text-3xl md:text-5xl font-semibold mb-8 text-balance break-words hyphens-auto">{{ $titlu }}</h1>

            <div class="prose prose-stone max-w-none text-forest-dark/80">
                <h2 class="font-display text-forest">{{ __('Identificarea societatii') }}</h2>
                <dl class="not-prose grid gap-x-8 gap-y-3 sm:grid-cols-[max-content_1fr] text-sm">
                    <dt class="font-semibold text-forest">{{ __('Denumire') }}</dt>
                    <dd>{{ $company['denumire'] }}</dd>

                    <dt class="font-semibold text-forest">{{ __('Forma juridica') }}</dt>
                    <dd>{{ $company['forma'] }}</dd>

                    <dt class="font-semibold text-forest">{{ __('Cod unic de inregistrare (CUI)') }}</dt>
                    <dd>{{ $codFiscal }}@if($company['tva']) — {{ __('Platitor de TVA') }}@endif</dd>

                    <dt class="font-semibold text-forest">{{ __('Nr. Registrul Comertului') }}</dt>
                    <dd>{{ $company['reg_com'] }}</dd>

                    <dt class="font-semibold text-forest">EUID</dt>
                    <dd>{{ $company['euid'] }}</dd>

                    <dt class="font-semibold text-forest">{{ __('Cod CAEN principal') }}</dt>
                    <dd>{{ $company['caen'] }}</dd>

                    <dt class="font-semibold text-forest">{{ __('Data infiintarii') }}</dt>
                    <dd>{{ \Carbon\Carbon::parse($company['data_infiintare'])->format('d.m.Y') }}</dd>

                    <dt class="font-semibold text-forest">{{ __('Sediu social') }}</dt>
                    <dd>{{ $adresaCompleta }}</dd>

                    <dt class="font-semibold text-forest">{{ __('Administrator') }}</dt>
                    <dd>{{ $company['administrator'] }}</dd>
                </dl>

                <h2 class="font-display text-forest">{{ __('Contact') }}</h2>
                <dl class="not-prose grid gap-x-8 gap-y-3 sm:grid-cols-[max-content_1fr] text-sm">
                    <dt class="font-semibold text-forest">{{ __('Telefon / WhatsApp') }}</dt>
                    <dd><a href="tel:{{ preg_replace('/\s+/', '', $company['telefon']) }}" class="underline hover:text-forest">{{ $company['telefon'] }}</a></dd>

                    <dt class="font-semibold text-forest">Email</dt>
                    <dd><a href="mailto:{{ $company['email'] }}" class="underline hover:text-forest">{{ $company['email'] }}</a></dd>
                </dl>

                <h2 class="font-display text-forest">{{ __('Responsabil pentru continut') }}</h2>
                <p>{{ $company['denumire'] }}, {{ __('prin reprezentantul sau legal') }}.</p>

                <p class="text-sm text-forest-dark/60">
                    {{ __('Pentru intrebari legate de protectia datelor, consultati') }}
                    <a href="{{ $loc === 'ro' ? '' : '/'.$loc }}/confidentialitate" class="underline hover:text-forest">{{ __('politica de confidentialitate') }}</a>.
                </p>
            </div>
        </div>
    </article>
</x-layouts.app>
