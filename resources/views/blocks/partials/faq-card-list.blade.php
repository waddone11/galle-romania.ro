{{-- Lista de carduri-acordeon FAQ (stilul de pe /intrebari-frecvente).
     Asteapta: $faqs (Collection<Faq>), $loc (string), $idPrefix (string, unic per sectiune). --}}
@foreach($faqs as $faq)
    @php
        $intrebare = $faq->getTranslation('intrebare', $loc) ?: $faq->getTranslation('intrebare', 'ro');
        $raspuns = $faq->getTranslation('raspuns', $loc) ?: $faq->getTranslation('raspuns', 'ro');
        $idRaspuns = $idPrefix.'-raspuns-'.$faq->id;
    @endphp
    <article
        x-data="{ open: false }"
        data-faq-card
        class="group rounded-2xl border-l-2 bg-white shadow-sm ring-1 transition motion-safe:hover:-translate-y-0.5 hover:shadow-md"
        :class="open ? 'border-mint ring-mint/30' : 'border-transparent ring-forest/10'"
    >
        <h3>
            <button
                type="button"
                @click="open = !open"
                aria-expanded="false"
                :aria-expanded="open.toString()"
                aria-controls="{{ $idRaspuns }}"
                class="flex w-full items-center justify-between gap-4 px-5 py-4 text-left sm:px-6 sm:py-5"
            >
                <span class="font-medium text-forest">{{ $intrebare }}</span>
                <span
                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full transition motion-safe:duration-300"
                    :class="open ? 'bg-mint text-white motion-safe:rotate-180' : 'bg-mint/15 text-forest'"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m6 9 6 6 6-6"/>
                    </svg>
                </span>
            </button>
        </h3>
        <div
            id="{{ $idRaspuns }}"
            class="grid grid-rows-[0fr] motion-safe:transition-[grid-template-rows] motion-safe:duration-300 motion-safe:ease-out"
            :class="open ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]'"
        >
            <div class="overflow-hidden">
                <p class="px-5 pb-5 text-sm leading-relaxed text-forest-dark/75 sm:px-6 sm:pb-6">{{ $raspuns }}</p>
            </div>
        </div>
    </article>
@endforeach
