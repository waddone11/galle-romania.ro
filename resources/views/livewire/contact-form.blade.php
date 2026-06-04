@php $loc = app()->getLocale(); @endphp
<div>
    @if($submitted)
        <div class="bg-mint/20 border border-mint rounded-2xl p-6 text-forest-dark">
            <p class="font-display text-xl font-semibold mb-2">{{ __('Multumim!') }}</p>
            <p>{{ __('Mesajul tau a fost trimis. Te contactam in cel mult 24h.') }}</p>
            <button type="button" wire:click="$set('submitted', false)" class="mt-4 text-sm text-forest hover:text-mint underline">{{ __('Trimite alt mesaj') }}</button>
        </div>
    @else
        <form wire:submit.prevent="submit" class="bg-mist-warm rounded-2xl p-6 space-y-4 border border-forest">
            {{-- Honeypot anti-spam — ascuns pentru oameni, completat doar de boti. --}}
            <div class="absolute left-[-9999px] top-auto h-px w-px overflow-hidden" aria-hidden="true">
                <label for="cf-website">{{ __('Nu completa acest camp') }}</label>
                <input id="cf-website" type="text" wire:model="website" tabindex="-1" autocomplete="off">
            </div>

            @error('throttle') <p class="text-sm text-rose-600 bg-rose-50 border border-forest rounded-lg px-3 py-2">{{ $message }}</p> @enderror

            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label for="cf-nume" class="text-sm font-medium block mb-1">{{ __('Nume') }} *</label>
                    <input id="cf-nume" type="text" wire:model="nume" required class="w-full rounded-lg border border-forest bg-white px-3 py-2 focus:border-mint focus:ring-mint">
                    @error('nume') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="cf-firma" class="text-sm font-medium block mb-1">{{ __('Firma (optional)') }}</label>
                    <input id="cf-firma" type="text" wire:model="firma" class="w-full rounded-lg border border-forest bg-white px-3 py-2 focus:border-mint focus:ring-mint">
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label for="cf-email" class="text-sm font-medium block mb-1">{{ __('Email') }} *</label>
                    <input id="cf-email" type="email" wire:model="email" required class="w-full rounded-lg border border-forest bg-white px-3 py-2 focus:border-mint focus:ring-mint">
                    @error('email') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="cf-telefon" class="text-sm font-medium block mb-1">{{ __('Telefon (optional)') }}</label>
                    <input id="cf-telefon" type="tel" wire:model="telefon" class="w-full rounded-lg border border-forest bg-white px-3 py-2 focus:border-mint focus:ring-mint">
                </div>
            </div>

            <div>
                <label for="cf-serviciu" class="text-sm font-medium block mb-1">{{ __('Serviciu de interes') }}</label>
                <select id="cf-serviciu" wire:model="serviciu" class="w-full rounded-lg border border-forest bg-white px-3 py-2 focus:border-mint focus:ring-mint">
                    <option value="">{{ __('— Alege —') }}</option>
                    <option value="forestier">{{ __('Servicii forestiere') }}</option>
                    <option value="peisagistica">{{ __('Peisagistica') }}</option>
                    <option value="compostare">{{ __('Compostare') }}</option>
                    <option value="lemn_de_foc">{{ __('Lemn de foc') }}</option>
                    <option value="altul">{{ __('Altul') }}</option>
                </select>
            </div>

            <div>
                <label for="cf-mesaj" class="text-sm font-medium block mb-1">{{ __('Mesaj') }} *</label>
                <textarea id="cf-mesaj" wire:model="mesaj" rows="4" required class="w-full rounded-lg border border-forest bg-white px-3 py-2 focus:border-mint focus:ring-mint"></textarea>
                @error('mesaj') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="cf-gdpr" class="flex items-start gap-2 text-sm text-forest-dark/80">
                    <input id="cf-gdpr" type="checkbox" wire:model="gdpr" class="mt-0.5 rounded border border-forest text-forest focus:ring-mint">
                    <span>{{ __('Sunt de acord cu prelucrarea datelor conform') }} <a href="{{ $loc === 'ro' ? '' : '/'.$loc }}/confidentialitate" class="underline hover:text-forest" target="_blank">{{ __('Politicii de confidentialitate') }}</a>.</span>
                </label>
                @error('gdpr') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
            </div>

            <div class="flex flex-wrap items-center gap-3 pt-2">
                <button type="submit" class="rounded-full bg-forest px-6 py-2.5 text-mist-warm hover:bg-forest-dark font-medium">
                    {{ __('Trimite mesajul') }}
                </button>
                <span wire:loading wire:target="submit" class="text-sm text-forest-dark/60">{{ __('Se trimite...') }}</span>
            </div>

            <p class="text-xs text-forest-dark/60">{{ __('Datele sunt folosite doar pentru a-ti raspunde — vezi') }} <a href="{{ $loc === 'ro' ? '' : '/'.$loc }}/confidentialitate" class="underline">{{ __('politica de confidentialitate') }}</a>.</p>
        </form>
    @endif
</div>
