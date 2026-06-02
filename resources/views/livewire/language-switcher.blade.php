<div x-data="{ open: false }" class="relative">
    <button type="button" @click="open = ! open" class="flex items-center gap-1 text-xs uppercase tracking-widest text-forest hover:text-mint">
        <span>{{ strtoupper($current) }}</span>
        <svg class="size-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
    </button>
    <div x-show="open" x-cloak @click.outside="open = false" class="absolute right-0 mt-2 w-24 rounded-lg bg-white border border-mist shadow-lg overflow-hidden text-sm">
        @foreach(['ro' => 'Romana', 'de' => 'Deutsch', 'en' => 'English'] as $code => $label)
            <button type="button" wire:click="switch('{{ $code }}')" class="block w-full text-left px-3 py-2 hover:bg-mist {{ $current === $code ? 'bg-mint/20 font-semibold' : '' }}">
                {{ $label }}
            </button>
        @endforeach
    </div>
</div>
