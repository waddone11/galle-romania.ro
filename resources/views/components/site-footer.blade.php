@php
    $locale = app()->getLocale();
    $prefix = $locale === 'ro' ? '' : '/' . $locale;
    $settings = class_exists(\App\Settings\GeneralSettings::class) ? app(\App\Settings\GeneralSettings::class) : null;
    $email = $settings->email ?? 'contact@galle-silva.ro';
    $telefon = $settings->telefon ?? null;
    $program = $settings->program ?? __('Luni - Vineri, 09:00 - 18:00');
@endphp

<footer class="relative mt-24 bg-forest text-mist-warm overflow-hidden">
    {{-- Forest band: textured background layer --}}
    <div class="absolute inset-0 bg-gradient-to-b from-forest to-forest-dark opacity-95"></div>

    {{-- Forrest silhouette: SVG fallback when picture assets are missing --}}
    <svg
        viewBox="0 0 1200 120"
        class="absolute -top-1 left-0 right-0 w-full h-24 fill-forest"
        preserveAspectRatio="none"
        aria-hidden="true"
    >
        <path d="M0,100 Q50,40 100,80 T200,70 T300,90 T400,50 T500,80 T600,60 T700,90 T800,40 T900,70 T1000,50 T1100,80 T1200,60 L1200,120 L0,120 Z"/>
    </svg>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 grid gap-12 md:grid-cols-4">
        <div class="md:col-span-2">
            <div class="font-display text-3xl font-semibold mb-3">
                <span class="text-mist-warm">Galle</span> <span class="text-mint">Silva</span>
            </div>
            <p class="text-sm leading-relaxed text-mist max-w-md">
                Partener local <strong>Galle GmbH Germania</strong>. Lemn de foc, servicii forestiere,
                peisagistica si compostare. Standarde germane in Romania.
            </p>
        </div>

        <div>
            <h4 class="font-display text-lg mb-3 text-mint">{{ __('Site') }}</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ $prefix }}/lemn-de-foc" class="hover:text-mint">{{ __('Lemn de foc') }}</a></li>
                <li><a href="{{ $prefix }}/servicii" class="hover:text-mint">{{ __('Servicii') }}</a></li>
                <li><a href="{{ $prefix }}/proiecte" class="hover:text-mint">{{ __('Proiecte') }}</a></li>
                <li><a href="{{ $prefix }}/blog" class="hover:text-mint">{{ __('Blog') }}</a></li>
                <li><a href="{{ $prefix }}/despre" class="hover:text-mint">{{ __('Despre') }}</a></li>
            </ul>
        </div>

        <div>
            <h4 class="font-display text-lg mb-3 text-mint">{{ __('Contact') }}</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="mailto:{{ $email }}" class="hover:text-mint">{{ $email }}</a></li>
                @if($telefon)
                    <li><a href="tel:{{ $telefon }}" class="hover:text-mint">{{ $telefon }}</a></li>
                @endif
                <li>{{ $program }}</li>
            </ul>
            <div class="mt-4 flex gap-3 text-xs">
                <a href="{{ $prefix }}/termeni" class="hover:text-mint">{{ __('Termeni') }}</a>
                <a href="{{ $prefix }}/confidentialitate" class="hover:text-mint">{{ __('Confidentialitate') }}</a>
                <a href="{{ $prefix }}/cookies" class="hover:text-mint">{{ __('Cookies') }}</a>
            </div>
        </div>
    </div>

    <div class="relative border-t border-forest-dark/60">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6 text-xs text-mist/70 flex flex-col md:flex-row justify-between gap-2">
            <p>&copy; {{ date('Y') }} Galle Silva SRL. Toate drepturile rezervate.</p>
            <p>{{ __('Partener local') }} <a href="https://www.galle-gmbh.de" target="_blank" rel="noopener" class="hover:text-mint underline-offset-4 hover:underline">Galle GmbH Germania</a></p>
        </div>
    </div>
</footer>
