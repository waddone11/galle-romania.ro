<div class="bg-[#fafaf8] border border-forest rounded-2xl p-6 space-y-5">
    @php $loc = app()->getLocale(); @endphp
    <div>
        <label for="calc-specie" class="text-sm font-medium block mb-2">{{ __('Specie') }}</label>
        <select id="calc-specie" wire:model.live="specieId" class="w-full rounded-lg border border-forest bg-white px-3 py-2 focus:border-mint focus:ring-mint">
            @foreach($this->species as $sp)
                <option value="{{ $sp->id }}">{{ $sp->getTranslation('nume', $loc) ?: $sp->getTranslation('nume', 'ro') }} ({{ __($sp->status->label()) }})</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="calc-cantitate" class="text-sm font-medium block mb-2">{{ __('Cantitate') }} ({{ __($this->specie?->unitate->label() ?? 'ster') }})</label>
        <input id="calc-cantitate" type="number" min="0.5" step="0.5" wire:model.live="cantitate" class="w-full rounded-lg border border-forest bg-white px-3 py-2 focus:border-mint focus:ring-mint">
    </div>

    <div>
        <label for="calc-zona" class="text-sm font-medium block mb-2">{{ __('Zona livrare') }}</label>
        <select id="calc-zona" wire:model.live="zonaId" class="w-full rounded-lg border border-forest bg-white px-3 py-2 focus:border-mint focus:ring-mint">
            @foreach($this->zone as $z)
                <option value="{{ $z->id }}">{{ $z->judet }} (+{{ number_format($z->cost_livrare, 0) }} lei)</option>
            @endforeach
        </select>
    </div>

    <dl class="pt-4 border-t border-forest space-y-2 text-sm">
        <div class="flex justify-between">
            <dt class="text-forest-dark/70">{{ __('Lemn') }} ({{ $cantitate }} {{ $this->specie?->unitate->value ?? 'ster' }})</dt>
            <dd class="font-semibold">{{ number_format($this->pretLemn, 0) }} lei</dd>
        </div>
        <div class="flex justify-between">
            <dt class="text-forest-dark/70">{{ __('Livrare') }}</dt>
            <dd class="font-semibold">{{ number_format($this->costLivrare, 0) }} lei</dd>
        </div>
        <div class="flex justify-between pt-2 border-t border-forest text-lg">
            <dt class="font-display font-semibold">{{ __('Total estimat') }}</dt>
            <dd class="font-display font-semibold text-forest">{{ number_format($this->total, 0) }} lei</dd>
        </div>
    </dl>

    <p class="text-xs text-forest-dark/60">{{ __('Pret indicativ. Confirmarea finala dupa contactul de la noi.') }}</p>
</div>
