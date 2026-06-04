@php
    $locale = app()->getLocale();
    $prefix = $locale === 'ro' ? '' : '/' . $locale;
    $hasLanguageSwitcher = class_exists(\App\Livewire\LanguageSwitcher::class);
@endphp

<header
    x-data="{ open: false, scrolled: false }"
    x-init="scrolled = window.scrollY > 20"
    @scroll.window="scrolled = window.scrollY > 20"
    class="sticky top-0 z-40 transition-colors duration-300"
    :class="scrolled ? 'bg-white/90 backdrop-blur-md border-b border-mist shadow-sm' : 'bg-transparent border-b border-transparent'"
>
    <nav class="mx-auto max-w-7xl px-4 md:px-0" aria-label="Navigatie principala">
        <div class="flex h-16 items-center justify-between">
            <a href="{{ $prefix }}/" class="flex items-center" aria-label="Galle Silva - Acasa">
                <img
                    src="{{ asset('images/galle/logo/logo-nav-96.png') }}"
                    srcset="{{ asset('images/galle/logo/logo-nav-96.png') }} 1x, {{ asset('images/galle/logo/logo-nav-192.png') }} 2x"
                    alt="Galle Silva"
                    class="h-10 w-auto"
                    width="370" height="96"
                >
            </a>

            <div class="hidden lg:flex items-center gap-8 text-sm font-medium">
                <a href="{{ $prefix }}/" class="hover:text-mint transition-colors">{{ __('Acasa') }}</a>
                <a href="{{ $prefix }}/servicii" class="hover:text-mint transition-colors">{{ __('Servicii') }}</a>
                <a href="{{ $prefix }}/lemn-de-foc" class="hover:text-mint transition-colors">{{ __('Lemn de foc') }}</a>
                <a href="{{ $prefix }}/despre" class="hover:text-mint transition-colors">{{ __('Despre') }}</a>
                {{-- Secundarele (portofoliu, blog, certificari, FAQ) stau grupate ca sa nu aglomereze bara. --}}
                <div x-data="{ resurse: false }" @click.outside="resurse = false" class="relative">
                    <button
                        type="button"
                        @click="resurse = !resurse"
                        class="inline-flex items-center gap-1 hover:text-mint transition-colors"
                        :aria-expanded="resurse"
                        aria-haspopup="true"
                    >
                        {{ __('Resurse') }}
                        <svg class="size-4 transition-transform" :class="resurse ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div
                        x-show="resurse"
                        x-cloak
                        x-transition.opacity.duration.150ms
                        class="absolute right-0 top-full mt-3 w-60 rounded-xl bg-white border border-mist shadow-lg shadow-forest/10 py-2"
                    >
                        <a href="{{ $prefix }}/proiecte" class="block px-4 py-2 hover:bg-mist/60 hover:text-mint transition-colors">{{ __('Proiecte') }}</a>
                        <a href="{{ $prefix }}/blog" class="block px-4 py-2 hover:bg-mist/60 hover:text-mint transition-colors">{{ __('Blog') }}</a>
                        <a href="{{ $prefix }}/certificari" class="block px-4 py-2 hover:bg-mist/60 hover:text-mint transition-colors">{{ __('Certificari') }}</a>
                        <a href="{{ $prefix }}/intrebari-frecvente" class="block px-4 py-2 hover:bg-mist/60 hover:text-mint transition-colors">{{ __('Intrebari frecvente') }}</a>
                    </div>
                </div>
                <a href="{{ $prefix }}/contact" class="hover:text-mint transition-colors">{{ __('Contact') }}</a>
            </div>

            <div class="hidden lg:flex items-center gap-4">
                @if($hasLanguageSwitcher)
                    <livewire:language-switcher />
                @else
                    <span class="text-xs text-forest/60 uppercase tracking-wide">{{ $locale }}</span>
                @endif
                <a href="{{ $prefix }}/contact"
                   class="inline-flex items-center rounded-full bg-mint px-6 py-2.5 text-sm font-semibold text-forest hover:brightness-105 transition">
                    {{ __('Cere oferta') }}
                </a>
            </div>

            <div class="lg:hidden flex items-center gap-2">
                <button
                    @click="open = !open"
                    class="inline-flex items-center justify-center rounded-md p-2 text-forest hover:bg-mist"
                    aria-label="Meniu mobil"
                    :aria-expanded="open"
                >
                    <svg x-show="!open" class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="open" x-cloak class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                @if($hasLanguageSwitcher)
                    <livewire:language-switcher />
                @endif
            </div>
        </div>

        <div x-show="open" x-cloak class="lg:hidden pb-4 space-y-2 text-sm">
            <a href="{{ $prefix }}/" class="block py-2">{{ __('Acasa') }}</a>
            <a href="{{ $prefix }}/servicii" class="block py-2">{{ __('Servicii') }}</a>
            <a href="{{ $prefix }}/lemn-de-foc" class="block py-2">{{ __('Lemn de foc') }}</a>
            <a href="{{ $prefix }}/despre" class="block py-2">{{ __('Despre') }}</a>
            <a href="{{ $prefix }}/contact" class="block py-2">{{ __('Contact') }}</a>
            <p class="pt-2 text-xs uppercase tracking-widest text-forest/50">{{ __('Resurse') }}</p>
            <a href="{{ $prefix }}/proiecte" class="block py-2">{{ __('Proiecte') }}</a>
            <a href="{{ $prefix }}/blog" class="block py-2">{{ __('Blog') }}</a>
            <a href="{{ $prefix }}/certificari" class="block py-2">{{ __('Certificari') }}</a>
            <a href="{{ $prefix }}/intrebari-frecvente" class="block py-2">{{ __('Intrebari frecvente') }}</a>
            <div class="pt-2 border-t border-mist flex items-center justify-end">
                <a href="{{ $prefix }}/contact" class="rounded-full bg-mint px-4 py-1.5 font-semibold text-forest">{{ __('Cere oferta') }}</a>
            </div>
        </div>
    </nav>
</header>
