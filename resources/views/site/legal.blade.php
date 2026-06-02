<x-layouts.app>
    <article class="py-16">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <h1 class="font-display text-4xl md:text-5xl font-semibold mb-8">{{ $pagina->getTranslation('titlu', 'ro') }}</h1>

            @if($pagina->sectiuni)
                @foreach((array) $pagina->getTranslation('sectiuni', 'ro') as $section)
                    @if(is_array($section) && isset($section['continut']))
                        <div class="prose prose-stone max-w-none mb-8">
                            {!! nl2br(e($section['continut'])) !!}
                        </div>
                    @endif
                @endforeach
            @else
                <div class="prose prose-stone max-w-none">
                    <p>Continut in pregatire. Pentru detalii contactati-ne la <a href="mailto:contact@galle-silva.ro">contact@galle-silva.ro</a>.</p>
                </div>
            @endif
        </div>
    </article>
</x-layouts.app>
