@php
    $locale = app()->getLocale();
    $prefix = $locale === 'ro' ? '' : '/' . $locale;
    $hasLanguageSwitcher = class_exists(\App\Livewire\LanguageSwitcher::class);
@endphp

<header
    x-data="{ open: false }"
    class="sticky top-0 z-40 bg-[#fafaf8]/85 backdrop-blur-md border-b border-mist"
>
    <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8" aria-label="Navigatie principala">
        <div class="flex h-16 items-center justify-between">
            <a href="{{ $prefix }}/" class="flex items-center gap-2 font-display text-2xl font-semibold">
                <span class="text-forest">Galle</span><span class="text-mint">Silva</span>
            </a>

            <div class="hidden lg:flex items-center gap-8 text-sm font-medium">
                <a href="{{ $prefix }}/" class="hover:text-mint transition-colors">{{ __('Acasa') }}</a>
                <a href="{{ $prefix }}/servicii" class="hover:text-mint transition-colors">{{ __('Servicii') }}</a>
                <a href="{{ $prefix }}/lemn-de-foc" class="hover:text-mint transition-colors">{{ __('Lemn de foc') }}</a>
                <a href="{{ $prefix }}/despre" class="hover:text-mint transition-colors">{{ __('Despre') }}</a>
                <a href="{{ $prefix }}/certificari" class="hover:text-mint transition-colors">{{ __('Certificari') }}</a>
                <a href="{{ $prefix }}/contact" class="hover:text-mint transition-colors">{{ __('Contact') }}</a>
            </div>

            <div class="hidden lg:flex items-center gap-4">
                @if($hasLanguageSwitcher)
                    <livewire:language-switcher />
                @else
                    <span class="text-xs text-forest/60 uppercase tracking-wide">{{ $locale }}</span>
                @endif
                <a href="{{ $prefix }}/contact"
                   class="inline-flex items-center rounded-full bg-forest px-5 py-2 text-sm font-medium text-mist-warm hover:bg-forest-dark transition-colors">
                    {{ __('Cere oferta') }}
                </a>
            </div>

            <button
                @click="open = !open"
                class="lg:hidden inline-flex items-center justify-center rounded-md p-2 text-forest hover:bg-mist"
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
        </div>

        <div x-show="open" x-cloak class="lg:hidden pb-4 space-y-2 text-sm">
            <a href="{{ $prefix }}/" class="block py-2">{{ __('Acasa') }}</a>
            <a href="{{ $prefix }}/servicii" class="block py-2">{{ __('Servicii') }}</a>
            <a href="{{ $prefix }}/lemn-de-foc" class="block py-2">{{ __('Lemn de foc') }}</a>
            <a href="{{ $prefix }}/despre" class="block py-2">{{ __('Despre') }}</a>
            <a href="{{ $prefix }}/certificari" class="block py-2">{{ __('Certificari') }}</a>
            <a href="{{ $prefix }}/contact" class="block py-2">{{ __('Contact') }}</a>
            <div class="pt-2 border-t border-mist flex items-center justify-between">
                @if($hasLanguageSwitcher)
                    <livewire:language-switcher />
                @endif
                <a href="{{ $prefix }}/contact" class="rounded-full bg-forest px-4 py-1.5 text-mist-warm">{{ __('Cere oferta') }}</a>
            </div>
        </div>
    </nav>
</header>
