<section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
        @foreach($data['imagini'] ?? [] as $img)
            @php $url = is_array($img) ? ($img['url'] ?? null) : $img; @endphp
            @if($url)
                <div class="aspect-square rounded-xl overflow-hidden bg-forest/10">
                    <img src="{{ $url }}" alt="" class="w-full h-full object-cover" loading="lazy">
                </div>
            @endif
        @endforeach
    </div>
</section>
