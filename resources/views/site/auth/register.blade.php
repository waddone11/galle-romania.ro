<x-layouts.app
    :title="__('Cont nou — Galle Silva')"
    :metaDescription="__('Creeaza-ti un cont Galle Silva.')"
>
    <section class="bg-forest text-mist-warm py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-display text-4xl md:text-5xl font-semibold">{{ __('Cont nou') }}</h1>
            <p class="mt-4 text-lg text-mist">{{ __('Creeaza-ti un cont Galle Silva.') }}</p>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <livewire:auth.register />
        </div>
    </section>
</x-layouts.app>
