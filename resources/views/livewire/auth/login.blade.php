@php
    $locale = app()->getLocale();
    $prefix = $locale === 'ro' ? '' : '/' . $locale;
@endphp
<div class="w-full max-w-md mx-auto">
    <form wire:submit.prevent="submit" class="bg-mist-warm rounded-2xl p-6 sm:p-8 space-y-4 border border-forest">
        <div>
            <label for="login-email" class="text-sm font-medium block mb-1">{{ __('Email') }} *</label>
            <input id="login-email" type="email" wire:model="email" required autocomplete="email"
                   class="w-full rounded-lg border border-forest bg-white px-3 py-2 focus:border-mint focus:ring-mint">
            @error('email') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="login-password" class="text-sm font-medium block mb-1">{{ __('Parola') }} *</label>
            <input id="login-password" type="password" wire:model="password" required autocomplete="current-password"
                   class="w-full rounded-lg border border-forest bg-white px-3 py-2 focus:border-mint focus:ring-mint">
            @error('password') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" wire:model="remember" class="rounded border-forest text-mint focus:ring-mint">
            {{ __('Tine-ma minte') }}
        </label>

        <button type="submit"
                class="w-full rounded-lg bg-forest text-mist px-4 py-2.5 font-semibold hover:bg-forest-dark transition"
                wire:loading.attr="disabled">
            <span wire:loading.remove>{{ __('Autentificare') }}</span>
            <span wire:loading>{{ __('Se trimite...') }}</span>
        </button>

        <p class="text-sm text-center text-forest/70">
            {{ __('Nu ai cont?') }}
            <a href="{{ $prefix }}/inregistrare" class="text-forest font-medium hover:text-mint underline underline-offset-2">{{ __('Cont nou') }}</a>
        </p>
    </form>
</div>
