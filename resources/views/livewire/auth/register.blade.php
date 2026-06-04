@php
    $locale = app()->getLocale();
    $prefix = $locale === 'ro' ? '' : '/' . $locale;
@endphp
<div class="w-full max-w-md mx-auto">
    <form wire:submit.prevent="submit" class="bg-mist-warm rounded-2xl p-6 sm:p-8 space-y-4 border border-forest">
        <div>
            <label for="register-name" class="text-sm font-medium block mb-1">{{ __('Nume') }} *</label>
            <input id="register-name" type="text" wire:model="name" required autocomplete="name"
                   class="w-full rounded-lg border border-forest bg-white px-3 py-2 focus:border-mint focus:ring-mint">
            @error('name') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="register-email" class="text-sm font-medium block mb-1">{{ __('Email') }} *</label>
            <input id="register-email" type="email" wire:model="email" required autocomplete="email"
                   class="w-full rounded-lg border border-forest bg-white px-3 py-2 focus:border-mint focus:ring-mint">
            @error('email') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="register-password" class="text-sm font-medium block mb-1">{{ __('Parola') }} *</label>
            <input id="register-password" type="password" wire:model="password" required autocomplete="new-password"
                   class="w-full rounded-lg border border-forest bg-white px-3 py-2 focus:border-mint focus:ring-mint">
            <p class="text-xs text-forest/60 mt-1">{{ __('Minim 8 caractere.') }}</p>
            @error('password') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="register-password-confirmation" class="text-sm font-medium block mb-1">{{ __('Confirma parola') }} *</label>
            <input id="register-password-confirmation" type="password" wire:model="password_confirmation" required autocomplete="new-password"
                   class="w-full rounded-lg border border-forest bg-white px-3 py-2 focus:border-mint focus:ring-mint">
        </div>

        <button type="submit"
                class="w-full rounded-lg bg-forest text-mist px-4 py-2.5 font-semibold hover:bg-forest-dark transition"
                wire:loading.attr="disabled">
            <span wire:loading.remove>{{ __('Creeaza cont') }}</span>
            <span wire:loading>{{ __('Se trimite...') }}</span>
        </button>

        <p class="text-sm text-center text-forest/70">
            {{ __('Ai deja cont?') }}
            <a href="{{ $prefix }}/autentificare" class="text-forest font-medium hover:text-mint underline underline-offset-2">{{ __('Autentificare') }}</a>
        </p>
    </form>
</div>
