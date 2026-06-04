@php
    $locale = app()->getLocale();
    $prefix = $locale === 'ro' ? '' : '/' . $locale;
    $settings = class_exists(\App\Settings\GeneralSettings::class) ? app(\App\Settings\GeneralSettings::class) : null;
    $email = $settings->email ?? 'info@galle-silva.com';
    $telefon = $settings->telefon ?? null;
    $adresa = $settings->adresa ?? 'Manesti, Str. Principala 302, jud. Prahova';
    $program = $settings->program ?? __('Luni - Vineri, 09:00 - 18:00');
@endphp

<footer class="text-mist">
    {{-- Layered forest: textured back band + silhouette image on top --}}
    <div class="forest-bandt">
        <picture>
            <source srcset="{{ asset('images/galle/forrest_front.webp') }}" type="image/webp">
            <source srcset="{{ asset('images/galle/forrest_front.jpg') }}" type="image/jpeg">
            <img class="front-img" src="{{ asset('images/galle/forrest_front.png') }}" alt="" width="1920" height="683" loading="lazy" decoding="async">
        </picture>
    </div>
    <div class="bg-forest w-full -mt-2">
        <div class="max-w-7xl mx-auto px-6 py-14 bg-forest">
            <div class="grid gap-10 md:grid-cols-4">
                <div class="md:col-span-2">
                    <img
                        src="{{ asset('images/galle/logo/logo-galle-footer.png') }}"
                        srcset="{{ asset('images/galle/logo/logo-galle-footer.png') }} 1x, {{ asset('images/galle/logo/logo-galle-footer@2x.png') }} 2x"
                        alt="Galle Silva"
                        class="h-24 w-auto"
                        width="481" height="200"
                        loading="lazy" decoding="async"
                    >
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
                        <li><a href="{{ $prefix }}/blog" class="hover:text-mint transition">{{ __('Blog') }}</a></li>
                        <li><a href="{{ $prefix }}/intrebari-frecvente" class="hover:text-mint transition">{{ __('Intrebari frecvente') }}</a></li>
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
                    <x-social-links variant="footer" class="mt-3 -ml-2.5" />
                    <div class="mt-4 flex flex-wrap gap-3 text-xs">
                        <a href="{{ $prefix }}/termeni" class="hover:text-mint">{{ __('Termeni') }}</a>
                        <a href="{{ $prefix }}/confidentialitate" class="hover:text-mint">{{ __('Confidentialitate') }}</a>
                        <a href="{{ $prefix }}/cookies" class="hover:text-mint">{{ __('Cookies') }}</a>
                        <a href="{{ $prefix }}/date-firma" class="hover:text-mint">{{ __('Date firma') }}</a>
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ url('/admin') }}" class="hover:text-mint">{{ __('Admin') }}</a>
                            @endif
                            <form method="POST" action="{{ $prefix }}/logout" class="inline">
                                @csrf
                                <button type="submit" class="hover:text-mint">{{ __('Iesire') }}</button>
                            </form>
                        @else
                            <a href="{{ $prefix }}/autentificare" class="hover:text-mint">{{ __('Autentificare') }}</a>
                            <a href="{{ $prefix }}/inregistrare" class="hover:text-mint">{{ __('Cont nou') }}</a>
                        @endauth
                        <button type="button"
                                onclick="window.dispatchEvent(new CustomEvent('galle-open-cookie-settings'))"
                                class="hover:text-mint underline-offset-2 hover:underline">
                            {{ __('Setari cookies') }}
                        </button>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-6 border-t border-mist/10 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-mist/50">
                <span>&copy; {{ date('Y') }} Galle Silva SRL. {{ __('Toate drepturile rezervate.') }}</span>
                <span>{{ __('Partener local') }}
                    <a href="https://www.galle-gmbh.de" target="_blank" rel="noopener" class="hover:text-mint underline-offset-4 hover:underline">Galle GmbH Germania</a>
                </span>
            </div>
            {{-- Linia legala (date publice registru — config/company.php) --}}
            <p class="mt-3 text-center sm:text-left text-[11px] text-mist/40">
                {{ config('company.denumire') }} · CUI {{ (config('company.tva') ? 'RO' : '').config('company.cui') }} · Reg. Com. {{ config('company.reg_com') }} ·
                <a href="{{ $prefix }}/date-firma" class="hover:text-mint underline-offset-2 hover:underline">{{ __('Date firma') }}</a>
            </p>
        </div>
    </div>
</footer>



{{-- <footer class="bg-forest text-mist">
    <div class="forest-band">
       <picture>
            <source srcset="{{ asset('images/galle/forrest_front.webp') }}" type="image/webp">
            <source srcset="{{ asset('images/galle/forrest_front.jpg') }}" type="image/jpeg">
            <img class="front-img" src="{{ asset('images/galle/forrest_front.png') }}" alt="" width="1920" height="683" loading="lazy" decoding="async">
        </picture>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-14">
      <div class="grid gap-10 md:grid-cols-4">
        <div class="md:col-span-2">
          <span class="font-display text-2xl font-extrabold">Galle<span class="text-mint"> Silva</span></span>
          <p class="mt-4 text-sm text-mist/60 max-w-xs font-light">
            Servicii forestiere si lemn de foc, cu grija pentru padure si mediu.
          </p>
        </div>
        <div>
          <h4 class="text-mint text-sm font-semibold uppercase tracking-wider">Companie</h4>
          <ul class="mt-4 space-y-2 text-sm text-mist/70">
            <li><a href="#" class="hover:text-mint transition">Despre</a></li>
            <li><a href="#" class="hover:text-mint transition">Servicii</a></li>
            <li><a href="#" class="hover:text-mint transition">Sustenabilitate</a></li>
          </ul>
        </div>
        <div>
          <h4 class="text-mint text-sm font-semibold uppercase tracking-wider">Contact</h4>
          <ul class="mt-4 space-y-2 text-sm text-mist/70">
            <li><a href="#" class="hover:text-mint transition">Ploiesti, Prahova</a></li>
            <li><a href="#" class="hover:text-mint transition">contact@galle-silva.com</a></li>
          </ul>
        </div>
      </div>
      <div class="mt-12 pt-6 border-t border-mist/10 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-mist/50">
        <span>© 2026 Galle Silva SRL. Toate drepturile rezervate.</span>
        <span>Construit cu Tailwind.</span>
      </div>
    </div>
</footer> --}}
