@php
    $loc = app()->getLocale();
    $query = \App\Models\Faq::where('is_published', true)->orderBy('ordine');
    if (! empty($data['categorie'])) {
        $query->where('categorie', $data['categorie']);
    }
    $faqs = $query->get();
@endphp

<section class="bg-mist-warm py-16">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        @if($titlu = ($data['titlu'][$loc] ?? $data['titlu']['ro'] ?? null))
            <h2 class="font-display text-3xl font-semibold mb-8 text-center">{{ $titlu }}</h2>
        @endif
        <div class="space-y-4">
            @foreach($faqs as $faq)
                <details class="bg-[#fafaf8] rounded-xl p-4 group">
                    <summary class="font-medium cursor-pointer flex justify-between items-center">
                        <span>{{ $faq->getTranslation('intrebare', $loc) ?: $faq->getTranslation('intrebare', 'ro') }}</span>
                        <span class="text-mint group-open:rotate-180 transition-transform">▾</span>
                    </summary>
                    <p class="mt-3 text-sm text-forest-dark/80">{{ $faq->getTranslation('raspuns', $loc) ?: $faq->getTranslation('raspuns', 'ro') }}</p>
                </details>
            @endforeach
        </div>
    </div>
</section>
