<x-layouts.app
    :title="__('Contact — Galle Silva | lemn de foc si servicii forestiere')"
    :metaDescription="__('Contacteaza Galle Silva pentru lemn de foc, servicii forestiere, peisagistica sau compostare. Raspundem in cel mult 24h. Prahova, Ilfov, Bucuresti.')"
>
    @php
        $settings = app(\App\Settings\GeneralSettings::class);
    @endphp

    <section class="bg-forest text-mist-warm py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-display text-3xl md:text-5xl font-semibold text-balance break-words hyphens-auto">{{ __('Contact') }}</h1>
            <p class="mt-4 text-lg text-mist">{{ __('Spune-ne de ce ai nevoie. Te contactam in 24h.') }}</p>
        </div>
    </section>

    <section class="py-16">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12">
            <div>
                <h2 class="font-display text-2xl font-semibold mb-6 text-balance break-words hyphens-auto">{{ __('Date contact') }}</h2>
                <dl class="space-y-4 text-sm">
                    <div>
                        <dt class="text-forest-dark/60 text-xs uppercase tracking-widest mb-1">Email</dt>
                        <dd><a href="mailto:{{ $settings->email }}" class="text-forest font-medium hover:text-mint">{{ $settings->email }}</a></dd>
                    </div>
                    <div>
                        <dt class="text-forest-dark/60 text-xs uppercase tracking-widest mb-1">{{ __('Telefon') }}</dt>
                        <dd><a href="tel:{{ $settings->telefon }}" class="text-forest font-medium hover:text-mint">{{ $settings->telefon }}</a></dd>
                    </div>
                    <div>
                        <dt class="text-forest-dark/60 text-xs uppercase tracking-widest mb-1">{{ __('Program') }}</dt>
                        <dd>{{ $settings->program }}</dd>
                    </div>
                    <div>
                        <dt class="text-forest-dark/60 text-xs uppercase tracking-widest mb-1">{{ __('Zone deservite') }}</dt>
                        <dd>Prahova, Ilfov, Bucuresti</dd>
                    </div>
                </dl>

                <x-social-links variant="inline" class="mt-6 -ml-2.5" />

                <div class="mt-8 rounded-xl bg-mist-warm p-4 text-sm">
                    <p class="text-forest-dark/70">{{ __('Pentru o discutie rapida —') }} <a href="https://wa.me/{{ preg_replace('/\D/', '', $settings->whatsapp) }}" target="_blank" rel="noopener" class="text-mint hover:text-forest font-medium">WhatsApp</a> {{ __('sau email direct.') }}</p>
                </div>
            </div>

            <div>
                <h2 class="font-display text-2xl font-semibold mb-6 text-balance break-words hyphens-auto">{{ __('Cere oferta') }}</h2>
                <livewire:contact-form />
            </div>
        </div>
    </section>
</x-layouts.app>
