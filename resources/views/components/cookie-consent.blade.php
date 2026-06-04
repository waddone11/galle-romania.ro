@php
    $locale = app()->getLocale();
    $prefix = $locale === 'ro' ? '' : '/'.$locale;
@endphp
{{-- GDPR/DSGVO cookie consent — opt-in granular.
     Categorii: necesare (mereu active) / analiza (opt-in) / marketing (opt-in).
     Scripturile non-esentiale se marcheaza <script type="text/plain" data-consent="analytics|marketing">
     si sunt activate DOAR dupa consimtamant (gate-ul de mai jos). Alegerea se stocheaza
     in localStorage `galle_cookie_consent` (v2: categorii + timestamp + versiune) si se
     poate schimba oricand din footer („Setari cookies"). --}}
<script>
    window.galleApplyConsent = function (consent) {
        window.galleConsent = consent;
        document.querySelectorAll('script[type="text/plain"][data-consent]').forEach(function (el) {
            if (! consent || ! consent.categories || ! consent.categories[el.dataset.consent]) {
                return;
            }
            var s = document.createElement('script');
            Array.from(el.attributes).forEach(function (a) {
                if (a.name !== 'type' && a.name !== 'data-consent') s.setAttribute(a.name, a.value);
            });
            s.type = 'text/javascript';
            s.text = el.text;
            el.replaceWith(s);
        });
        window.dispatchEvent(new CustomEvent('galle:consent', { detail: consent }));
    };
    window.galleConsent = JSON.parse(localStorage.getItem('galle_cookie_consent') || 'null');
    if (window.galleConsent && window.galleConsent.version === 2) {
        window.galleApplyConsent(window.galleConsent);
    }
</script>

<div
    x-data="{
        show: false,
        settings: false,
        analytics: false,
        marketing: false,
        saved() { return JSON.parse(localStorage.getItem('galle_cookie_consent') || 'null'); },
        init() {
            const c = this.saved();
            this.show = ! (c && c.version === 2);
        },
        open() {
            const c = this.saved();
            this.analytics = !! (c && c.categories && c.categories.analytics);
            this.marketing = !! (c && c.categories && c.categories.marketing);
            this.settings = true;
            this.show = true;
        },
        save(analytics, marketing) {
            const consent = {
                version: 2,
                timestamp: Date.now(),
                categories: { necessary: true, analytics: analytics, marketing: marketing },
            };
            localStorage.setItem('galle_cookie_consent', JSON.stringify(consent));
            window.galleApplyConsent(consent);
            this.show = false;
            this.settings = false;
        },
    }"
    @galle-open-cookie-settings.window="open()"
    x-show="show"
    x-cloak
    x-transition.opacity
    role="dialog"
    aria-live="polite"
    aria-label="{{ __('Consimtamant cookie-uri') }}"
    class="fixed inset-x-0 bottom-0 z-[60] p-4 sm:p-5"
>
    <div class="mx-auto max-w-4xl rounded-2xl border border-mist bg-[#fafaf8] shadow-xl shadow-forest/10 p-5">
        <p class="text-sm text-forest-dark/80">
            {{ __('Folosim cookie-uri necesare pentru functionarea site-ului. Cu acordul tau, putem folosi si cookie-uri de analiza sau marketing. Vezi') }}
            <a href="{{ $prefix }}/cookies" class="underline hover:text-forest">{{ __('politica de cookies') }}</a>
            {{ __('si') }}
            <a href="{{ $prefix }}/confidentialitate" class="underline hover:text-forest">{{ __('politica de confidentialitate') }}</a>.
        </p>

        {{-- Setari granulare pe categorii --}}
        <div x-show="settings" x-cloak class="mt-4 space-y-2 border-t border-mist pt-4 text-sm">
            <label class="flex items-center justify-between gap-4">
                <span>
                    <span class="font-semibold text-forest">{{ __('Strict necesare') }}</span>
                    <span class="block text-xs text-forest-dark/60">{{ __('Sesiune si securitate (CSRF). Nu pot fi dezactivate.') }}</span>
                </span>
                <input type="checkbox" checked disabled class="rounded border-mist text-forest opacity-60">
            </label>
            <label class="flex items-center justify-between gap-4">
                <span>
                    <span class="font-semibold text-forest">{{ __('Analiza') }}</span>
                    <span class="block text-xs text-forest-dark/60">{{ __('Statistici anonime de utilizare, doar cu acordul tau.') }}</span>
                </span>
                <input type="checkbox" x-model="analytics" class="rounded border-mist text-forest focus:ring-mint">
            </label>
            <label class="flex items-center justify-between gap-4">
                <span>
                    <span class="font-semibold text-forest">{{ __('Marketing') }}</span>
                    <span class="block text-xs text-forest-dark/60">{{ __('Continut si masurare publicitara, doar cu acordul tau.') }}</span>
                </span>
                <input type="checkbox" x-model="marketing" class="rounded border-mist text-forest focus:ring-mint">
            </label>
        </div>

        {{-- Butoane cu greutate vizuala egala --}}
        <div class="mt-4 flex flex-wrap gap-3">
            <button type="button" @click="save(true, true)"
                    class="rounded-full border-2 border-forest bg-forest px-5 py-2 text-sm font-semibold text-mist-warm hover:bg-forest-dark transition">
                {{ __('Accept toate') }}
            </button>
            <button type="button" @click="save(false, false)"
                    class="rounded-full border-2 border-forest bg-forest px-5 py-2 text-sm font-semibold text-mist-warm hover:bg-forest-dark transition">
                {{ __('Refuz') }}
            </button>
            <button type="button" x-show="! settings" @click="settings = true"
                    class="rounded-full border-2 border-forest bg-forest px-5 py-2 text-sm font-semibold text-mist-warm hover:bg-forest-dark transition">
                {{ __('Setari') }}
            </button>
            <button type="button" x-show="settings" x-cloak @click="save(analytics, marketing)"
                    class="rounded-full border-2 border-forest bg-forest px-5 py-2 text-sm font-semibold text-mist-warm hover:bg-forest-dark transition">
                {{ __('Salveaza setarile') }}
            </button>
        </div>
    </div>
</div>
