@php
    $settings = class_exists(\App\Settings\GeneralSettings::class) ? app(\App\Settings\GeneralSettings::class) : null;
    $whatsapp = preg_replace('/[^0-9]/', '', $settings->whatsapp ?? '');
    $loc = app()->getLocale();
@endphp
<div>
    @if($submitted)
        <div class="bg-mint/20 border border-mint rounded-2xl p-6 text-forest-dark">
            <p class="font-display text-xl font-semibold mb-2">{{ __('Multumim!') }}</p>
            <p>{{ __('Comanda ta a fost preluata. Te contactam in cel mult 24h pentru confirmare.') }}@if($whatsapp) {{ __('Pana atunci poti vorbi cu noi pe') }} <a href="https://wa.me/{{ $whatsapp }}" class="text-forest underline">WhatsApp</a>.@endif</p>
            <button type="button" wire:click="$set('submitted', false)" class="mt-4 text-sm text-forest hover:text-mint underline">{{ __('Trimite alta comanda') }}</button>
        </div>
    @else
        <form wire:submit.prevent="submit" class="bg-[#fafaf8] border border-mist rounded-2xl p-6 space-y-4">
            {{-- Honeypot anti-spam — ascuns pentru oameni, completat doar de boti. --}}
            <div class="absolute left-[-9999px] top-auto h-px w-px overflow-hidden" aria-hidden="true">
                <label for="of-website">{{ __('Nu completa acest camp') }}</label>
                <input id="of-website" type="text" wire:model="website" tabindex="-1" autocomplete="off">
            </div>

            @error('throttle') <p class="text-sm text-rose-600 bg-rose-50 border border-rose-200 rounded-lg px-3 py-2">{{ $message }}</p> @enderror

            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label for="of-nume" class="text-sm font-medium block mb-1">{{ __('Nume') }} *</label>
                    <input id="of-nume" type="text" wire:model="nume" required class="w-full rounded-lg border-mist bg-white px-3 py-2 focus:border-mint focus:ring-mint">
                    @error('nume') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="of-telefon" class="text-sm font-medium block mb-1">{{ __('Telefon') }} *</label>
                    <input id="of-telefon" type="tel" wire:model="telefon" required class="w-full rounded-lg border-mist bg-white px-3 py-2 focus:border-mint focus:ring-mint">
                    @error('telefon') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label for="of-email" class="text-sm font-medium block mb-1">{{ __('Email (optional)') }}</label>
                    <input id="of-email" type="email" wire:model="email" class="w-full rounded-lg border-mist bg-white px-3 py-2 focus:border-mint focus:ring-mint">
                    @error('email') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="of-localitate" class="text-sm font-medium block mb-1">{{ __('Localitate') }} *</label>
                    <input id="of-localitate" type="text" wire:model="localitate" required class="w-full rounded-lg border-mist bg-white px-3 py-2 focus:border-mint focus:ring-mint">
                    @error('localitate') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid sm:grid-cols-3 gap-4">
                <div>
                    <label for="of-specie" class="text-sm font-medium block mb-1">{{ __('Specie') }}</label>
                    <select id="of-specie" wire:model="specieId" class="w-full rounded-lg border-mist bg-white px-3 py-2 focus:border-mint focus:ring-mint">
                        @foreach($species as $sp)
                            <option value="{{ $sp->id }}">{{ $sp->getTranslation('nume', $loc) ?: $sp->getTranslation('nume', 'ro') }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="of-cantitate" class="text-sm font-medium block mb-1">{{ __('Cantitate') }} *</label>
                    <input id="of-cantitate" type="number" min="0.5" step="0.5" wire:model="cantitate" required class="w-full rounded-lg border-mist bg-white px-3 py-2 focus:border-mint focus:ring-mint">
                </div>
                <div>
                    <label for="of-unitate" class="text-sm font-medium block mb-1">{{ __('Unitate') }}</label>
                    <select id="of-unitate" wire:model="unitate" class="w-full rounded-lg border-mist bg-white px-3 py-2 focus:border-mint focus:ring-mint">
                        <option value="ster">{{ __('Metru ster') }}</option>
                        <option value="tona">{{ __('Tona') }}</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="of-data" class="text-sm font-medium block mb-1">{{ __('Data dorita (optional)') }}</label>
                <input id="of-data" type="date" wire:model="data_dorita" min="{{ now()->toDateString() }}" class="w-full rounded-lg border-mist bg-white px-3 py-2 focus:border-mint focus:ring-mint">
            </div>

            <div>
                <label for="of-mesaj" class="text-sm font-medium block mb-1">{{ __('Mesaj (optional)') }}</label>
                <textarea id="of-mesaj" wire:model="mesaj" rows="3" class="w-full rounded-lg border-mist bg-white px-3 py-2 focus:border-mint focus:ring-mint"></textarea>
            </div>

            <div>
                <label for="of-gdpr" class="flex items-start gap-2 text-sm text-forest-dark/80">
                    <input id="of-gdpr" type="checkbox" wire:model="gdpr" class="mt-0.5 rounded border-mist text-forest focus:ring-mint">
                    <span>{{ __('Sunt de acord cu prelucrarea datelor conform') }} <a href="{{ $loc === 'ro' ? '' : '/'.$loc }}/confidentialitate" class="underline hover:text-forest" target="_blank">{{ __('Politicii de confidentialitate') }}</a>.</span>
                </label>
                @error('gdpr') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
            </div>

            <div class="flex flex-wrap items-center gap-3 pt-2">
                <button type="submit" class="rounded-full bg-forest px-6 py-2.5 text-mist-warm hover:bg-forest-dark font-medium">
                    {{ __('Trimite comanda') }}
                </button>
                <span wire:loading wire:target="submit" class="text-sm text-forest-dark/60">{{ __('Se trimite...') }}</span>
            </div>

            <p class="text-xs text-forest-dark/60">{{ __('Datele sunt folosite doar pentru a procesa comanda ta — vezi') }} <a href="{{ $loc === 'ro' ? '' : '/'.$loc }}/confidentialitate" class="underline">{{ __('politica de confidentialitate') }}</a>.</p>
        </form>
    @endif
</div>
