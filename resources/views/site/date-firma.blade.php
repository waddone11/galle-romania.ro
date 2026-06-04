@php
    $loc = app()->getLocale();
    $titlu = $pagina?->getTranslation('titlu', $loc) ?: ($pagina?->getTranslation('titlu', 'ro') ?: __('Date firma / Impressum'));
    $meta = $pagina?->getTranslation('meta_description', $loc) ?: null;

    $settings = class_exists(\App\Settings\GeneralSettings::class) ? app(\App\Settings\GeneralSettings::class) : null;
    $telefon = $settings->telefon ?? '+40 729 961 082';
    $email = $settings->email ?? 'info@galle-silva.ro';
@endphp
<x-layouts.app
    :title="$titlu.' | Galle Silva'"
    :metaDescription="$meta"
>
    {{-- Impressum (cerinta DSGVO/TMG pentru owner german): datele de identificare ale firmei. --}}
    <article class="py-16">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <h1 class="font-display text-4xl md:text-5xl font-semibold mb-8">{{ $titlu }}</h1>

            <div class="prose prose-stone max-w-none text-forest-dark/80">
                <h2 class="font-display text-forest">{{ __('Identificarea societatii') }}</h2>
                <dl class="not-prose grid gap-x-8 gap-y-3 sm:grid-cols-[max-content_1fr] text-sm">
                    <dt class="font-semibold text-forest">{{ __('Denumire') }}</dt>
                    <dd>GALLE SILVA SRL</dd>

                    <dt class="font-semibold text-forest">{{ __('Cod unic de inregistrare (CUI)') }}</dt>
                    <dd>52771440</dd>

                    <dt class="font-semibold text-forest">{{ __('Nr. Registrul Comertului') }}</dt>
                    <dd>J2025081738000</dd>

                    <dt class="font-semibold text-forest">EUID</dt>
                    <dd>ROONRC.J2025081738000</dd>

                    <dt class="font-semibold text-forest">{{ __('Data infiintarii') }}</dt>
                    <dd>24.10.2025</dd>

                    <dt class="font-semibold text-forest">{{ __('Sediu social') }}</dt>
                    <dd>Str. Principala nr. 302, Sat Manesti, Comuna Manesti, jud. Prahova, 107375, Romania</dd>

                    <dt class="font-semibold text-forest">{{ __('Reprezentant') }}</dt>
                    <dd>Razvan Solzaru — {{ __('manager general') }}</dd>
                </dl>

                <h2 class="font-display text-forest">{{ __('Contact') }}</h2>
                <dl class="not-prose grid gap-x-8 gap-y-3 sm:grid-cols-[max-content_1fr] text-sm">
                    <dt class="font-semibold text-forest">{{ __('Telefon / WhatsApp') }}</dt>
                    <dd><a href="tel:{{ preg_replace('/\s+/', '', $telefon) }}" class="underline hover:text-forest">{{ $telefon }}</a></dd>

                    <dt class="font-semibold text-forest">Email</dt>
                    <dd><a href="mailto:{{ $email }}" class="underline hover:text-forest">{{ $email }}</a></dd>
                </dl>

                <h2 class="font-display text-forest">{{ __('Responsabil pentru continut') }}</h2>
                <p>GALLE SILVA SRL, {{ __('prin reprezentantul sau legal') }}.</p>

                <p class="text-sm text-forest-dark/60">
                    {{ __('Pentru intrebari legate de protectia datelor, consultati') }}
                    <a href="{{ $loc === 'ro' ? '' : '/'.$loc }}/confidentialitate" class="underline hover:text-forest">{{ __('politica de confidentialitate') }}</a>.
                </p>
            </div>
        </div>
    </article>
</x-layouts.app>
