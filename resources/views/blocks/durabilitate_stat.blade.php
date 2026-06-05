@php
    $loc = app()->getLocale();
    $t = fn (string $key) => $data[$key][$loc] ?? $data[$key]['ro'] ?? null;

    $titlu      = $t('titlu') ?? 'Durabil & regenerabil';
    $text       = $t('text') ?? 'Lemnul de foc Galle Silva provine din paduri gestionate responsabil — o resursa regenerabila. Certificari FSC si PEFC in lucru, in acord cu principalele standarde de sustenabilitate.';
    $statNumber = $data['stat_number'] ?? '100%';
    $statTop    = $t('stat_top') ?? 'natural';
    $statBottom = $t('stat_bottom') ?? '& regenerabil';
@endphp

<section class="relative grid lg:grid-cols-2 overflow-hidden">
    {{-- left: text on dark forest --}}
    <div class="bg-forest text-mist px-6 lg:px-16 py-20 lg:py-28 flex items-center">
        <div class="max-w-md">
            <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-extrabold leading-[0.95] text-balance break-words hyphens-auto">{{ $titlu }}</h2>
            <p class="mt-8 text-lg font-light text-mist/75 leading-relaxed">{{ $text }}</p>
        </div>
    </div>

    {{-- right: big stat on white --}}
    <div class="bg-white px-6 lg:px-16 py-20 lg:py-28 flex items-center justify-center">
        <div class="flex items-center gap-5">
            <span class="font-display font-extrabold text-forest leading-none tracking-tight text-8xl sm:text-9xl lg:text-[12rem]">
                {{ $statNumber }}
            </span>
            <div class="flex flex-col leading-none">
                <span class="font-display font-extrabold text-mint text-3xl sm:text-5xl lg:text-6xl">{{ $statTop }}</span>
                <span class="font-display font-bold text-forest text-base sm:text-lg lg:text-2xl mt-2">{{ $statBottom }}</span>
            </div>
        </div>
    </div>

</section>
