@php
    $locale = app()->getLocale();
    $prefix = $locale === 'ro' ? '' : '/' . $locale;
    $settings = class_exists(\App\Settings\GeneralSettings::class) ? app(\App\Settings\GeneralSettings::class) : null;
    $email = $settings->email ?? 'info@galle-silva.ro';
    $telefon = $settings->telefon ?? null;
    $adresa = $settings->adresa ?? 'Manesti, Str. Principala 302, jud. Prahova';
    $program = $settings->program ?? __('Luni - Vineri, 09:00 - 18:00');
@endphp

<footer class="bg-forest text-mist">
    {{-- Layered forest: textured back band + silhouette image on top --}}
    <div class="forest-band">
        <picture>
            <source srcset="{{ asset('images/galle/forrest_front.webp') }}" type="image/webp">
            <source srcset="{{ asset('images/galle/forrest_front.jpg') }}" type="image/jpeg">
            <img class="front-img" src="{{ asset('images/galle/forrest_front.png') }}" alt="" loading="lazy">
        </picture>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-14">
        <div class="grid gap-10 md:grid-cols-4">
            <div class="md:col-span-2">
                <span class="font-display text-2xl font-extrabold">Galle<span class="text-mint"> Silva</span></span>
                <p class="mt-4 text-sm text-mist/60 max-w-xs font-light">
                    {{ __('Servicii forestiere si lemn de foc, cu grija pentru padure si mediu. Partener local Galle GmbH Germania.') }}
                </p>
            </div>

            <div>
                <h4 class="text-mint text-sm font-semibold uppercase tracking-wider">{{ __('Companie') }}</h4>
                <ul class="mt-4 space-y-2 text-sm text-mist/70">
                    <li><a href="{{ $prefix }}/despre" class="hover:text-mint transition">{{ __('Despre') }}</a></li>
                    <li><a href="{{ $prefix }}/servicii" class="hover:text-mint transition">{{ __('Servicii') }}</a></li>
                    <li><a href="{{ $prefix }}/lemn-de-foc" class="hover:text-mint transition">{{ __('Lemn de foc') }}</a></li>
                    <li><a href="{{ $prefix }}/certificari" class="hover:text-mint transition">{{ __('Certificari') }}</a></li>
                    <li><a href="{{ $prefix }}/proiecte" class="hover:text-mint transition">{{ __('Proiecte') }}</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-mint text-sm font-semibold uppercase tracking-wider">{{ __('Contact') }}</h4>
                <ul class="mt-4 space-y-2 text-sm text-mist/70">
                    <li>{{ $adresa }}</li>
                    <li><a href="mailto:{{ $email }}" class="hover:text-mint transition">{{ $email }}</a></li>
                    @if($telefon)
                        <li><a href="tel:{{ preg_replace('/\s+/', '', $telefon) }}" class="hover:text-mint transition">{{ $telefon }}</a></li>
                    @endif
                    <li>{{ $program }}</li>
                </ul>
                <div class="mt-4 flex flex-wrap gap-3 text-xs">
                    <a href="{{ $prefix }}/termeni" class="hover:text-mint">{{ __('Termeni') }}</a>
                    <a href="{{ $prefix }}/confidentialitate" class="hover:text-mint">{{ __('Confidentialitate') }}</a>
                    <a href="{{ $prefix }}/cookies" class="hover:text-mint">{{ __('Cookies') }}</a>
                </div>
            </div>
        </div>

        <div class="mt-12 pt-6 border-t border-mist/10 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-mist/50">
            <span>&copy; {{ date('Y') }} Galle Silva SRL. {{ __('Toate drepturile rezervate.') }}</span>
            <span>{{ __('Partener local') }}
                <a href="https://www.galle-gmbh.de" target="_blank" rel="noopener" class="hover:text-mint underline-offset-4 hover:underline">Galle GmbH Germania</a>
            </span>
        </div>
    </div>
</footer>
