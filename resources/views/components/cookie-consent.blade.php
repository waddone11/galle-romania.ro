@php
    $locale = app()->getLocale();
    $prefix = $locale === 'ro' ? '' : '/'.$locale;
@endphp
{{-- GDPR cookie banner. Pure Alpine + localStorage. No trackers loaded.
     Site foloseste doar cookie-uri esentiale (sesiune/CSRF), deci consimtamantul
     este informativ — banner-ul apare o singura data per browser. --}}
<div
    x-data="{ show: false }"
    x-init="show = ! localStorage.getItem('galle_cookie_consent')"
    x-show="show"
    x-cloak
    x-transition.opacity
    role="dialog"
    aria-live="polite"
    aria-label="Consimtamant cookie-uri"
    class="fixed inset-x-0 bottom-0 z-[60] p-4 sm:p-5"
>
    <div class="mx-auto max-w-4xl rounded-2xl border border-mist bg-[#fafaf8] shadow-xl shadow-forest/10 p-5 sm:flex sm:items-center sm:gap-6">
        <p class="text-sm text-forest-dark/80 mb-3 sm:mb-0">
            Folosim doar cookie-uri esentiale pentru functionarea site-ului. Vezi
            <a href="{{ $prefix }}/cookies" class="underline hover:text-forest">politica de cookies</a>
            si
            <a href="{{ $prefix }}/confidentialitate" class="underline hover:text-forest">confidentialitatea</a>.
        </p>
        <button
            type="button"
            @click="localStorage.setItem('galle_cookie_consent', '1'); show = false"
            class="shrink-0 rounded-full bg-forest px-6 py-2.5 text-sm font-semibold text-mist-warm hover:bg-forest-dark transition"
        >
            Am inteles
        </button>
    </div>
</div>
