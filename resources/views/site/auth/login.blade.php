<x-layouts.app
    :title="__('Autentificare — Galle Silva')"
    :metaDescription="__('Autentifica-te in contul tau Galle Silva.')"
>
    <section class="bg-forest text-mist-warm py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-display text-3xl md:text-5xl font-semibold text-balance break-words hyphens-auto">{{ __('Autentificare') }}</h1>
            <p class="mt-4 text-lg text-mist">{{ __('Intra in contul tau Galle Silva.') }}</p>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <livewire:auth.login />
        </div>
    </section>
</x-layouts.app>
