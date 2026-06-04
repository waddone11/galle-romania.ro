<?php

namespace App\Http\Controllers;

use App\Models\Articol;
use App\Models\Certificare;
use App\Models\Faq;
use App\Models\Localitate;
use App\Models\Pagina;
use App\Models\Proiect;
use App\Models\Serviciu;
use App\Models\Specie;
use App\Models\ZonaLivrare;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function home(): View
    {
        $species = Specie::where('is_active', true)->orderBy('ordine')->get();
        $servicii = Serviciu::where('is_active', true)->orderBy('ordine')->get();
        $certificari = Certificare::where('is_active', true)->orderBy('ordine')->get();
        $articole = Articol::where('is_published', true)->orderByDesc('published_at')->limit(3)->get();
        $pagina = Pagina::where('slug', 'home')->where('is_published', true)->first();

        return view('site.home', compact('species', 'servicii', 'certificari', 'articole', 'pagina'));
    }

    public function lemnDeFoc(): View
    {
        return view('site.lemn-de-foc', $this->lemnDeFocData());
    }

    /**
     * Landing local SEO: /lemn-de-foc/{localitate}.
     * H1/titlu/intro localizate; restul continutului mostenit; canonical pe /lemn-de-foc.
     */
    public function lemnDeFocLocal(string $slug): View
    {
        $localitate = Localitate::where('slug', $slug)->where('is_active', true)->firstOrFail();

        return view('site.lemn-de-foc', [...$this->lemnDeFocData(), 'localitate' => $localitate]);
    }

    /** @return array<string, mixed> */
    private function lemnDeFocData(): array
    {
        $species = Specie::where('is_active', true)->orderBy('ordine')->get();
        $zone = ZonaLivrare::where('is_active', true)->orderBy('ordine')->get();
        $faqs = Faq::where('is_published', true)->where('categorie', 'lemn_de_foc')->orderBy('ordine')->get();
        $pagina = Pagina::where('slug', 'lemn-de-foc')->where('is_published', true)->first();

        return compact('species', 'zone', 'faqs', 'pagina');
    }

    public function servicii(): View
    {
        $pagina = Pagina::where('slug', 'servicii')->where('is_published', true)->firstOrFail();
        $loc = app()->getLocale();

        // Service JSON-LD pentru fiecare card din blocul `servicii` al paginii.
        $schemas = [];

        /** @var mixed $sectiuni */
        $sectiuni = $pagina->getAttribute('sectiuni');
        foreach (is_array($sectiuni) ? $sectiuni : [] as $block) {
            if (! is_array($block) || ($block['type'] ?? null) !== 'servicii') {
                continue;
            }
            foreach ((array) ($block['data']['items'] ?? []) as $item) {
                $nume = $item['titlu'][$loc] ?? $item['titlu']['ro'] ?? null;
                if (! $nume) {
                    continue;
                }
                $schemas[] = array_filter([
                    '@context' => 'https://schema.org',
                    '@type' => 'Service',
                    'name' => $nume,
                    'description' => $item['text'][$loc] ?? $item['text']['ro'] ?? null,
                    'url' => isset($item['url']) ? url($item['url']) : null,
                    'areaServed' => ['Prahova', 'Ilfov', 'Bucuresti'],
                    'provider' => ['@type' => 'Organization', 'name' => 'Galle Silva SRL'],
                ], fn ($v) => $v !== null && $v !== '');
            }
        }

        $schemas[] = $this->breadcrumbSchema([
            ['Acasa', url('/')],
            [$pagina->getTranslation('titlu', $loc) ?: 'Servicii', url()->current()],
        ]);

        return view('site.pagina', compact('pagina', 'schemas'));
    }

    public function serviciuPage(string $slug): View
    {
        $pagina = Pagina::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $loc = app()->getLocale();

        $faqs = Faq::where('is_published', true)->where('categorie', $slug)->orderBy('ordine')->get();

        $titlu = $pagina->getTranslation('titlu', $loc) ?: $pagina->getTranslation('titlu', 'ro');

        $schemas = [
            array_filter([
                '@context' => 'https://schema.org',
                '@type' => 'Service',
                'name' => $titlu,
                'description' => $pagina->getTranslation('meta_description', $loc) ?: $pagina->getTranslation('meta_description', 'ro'),
                'url' => url()->current(),
                'areaServed' => ['Prahova', 'Ilfov', 'Bucuresti'],
                'provider' => ['@type' => 'Organization', 'name' => 'Galle Silva SRL'],
            ], fn ($v) => $v !== null && $v !== ''),
        ];

        if ($faqs->isNotEmpty()) {
            $schemas[] = [
                '@context' => 'https://schema.org',
                '@type' => 'FAQPage',
                'mainEntity' => $faqs->map(fn (Faq $faq) => [
                    '@type' => 'Question',
                    'name' => $faq->getTranslation('intrebare', $loc) ?: $faq->getTranslation('intrebare', 'ro'),
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $faq->getTranslation('raspuns', $loc) ?: $faq->getTranslation('raspuns', 'ro'),
                    ],
                ])->values()->all(),
            ];
        }

        $prefix = $loc === 'ro' ? '' : '/'.$loc;
        $schemas[] = $this->breadcrumbSchema([
            ['Acasa', url($prefix.'/')],
            ['Servicii', url($prefix.'/servicii')],
            [$titlu, url()->current()],
        ]);

        return view('site.pagina', compact('pagina', 'schemas'));
    }

    /**
     * @param  array<int, array{0: string|null, 1: string}>  $items
     * @return array<string, mixed>
     */
    private function breadcrumbSchema(array $items): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => collect($items)->values()->map(fn (array $item, int $i) => [
                '@type' => 'ListItem',
                'position' => $i + 1,
                'name' => $item[0],
                'item' => $item[1],
            ])->all(),
        ];
    }

    public function institutii(): View
    {
        $servicii = Serviciu::where('is_active', true)
            ->whereIn('audienta', ['institutie', 'ambele'])
            ->orderBy('ordine')
            ->get();

        $pagina = Pagina::where('slug', 'institutii')->first();

        return view('site.institutii', compact('servicii', 'pagina'));
    }

    public function despre(): View
    {
        $pagina = Pagina::where('slug', 'despre')->first();
        $certificari = Certificare::where('is_active', true)->orderBy('ordine')->get();

        return view('site.despre', compact('pagina', 'certificari'));
    }

    public function certificari(): View
    {
        $certificari = Certificare::where('is_active', true)->orderBy('ordine')->get();
        $pagina = Pagina::where('slug', 'certificari')->first();

        return view('site.certificari', compact('certificari', 'pagina'));
    }

    public function proiecte(): View
    {
        $proiecte = Proiect::where('is_published', true)->orderBy('ordine')->get();

        return view('site.proiecte', compact('proiecte'));
    }

    public function proiect(string $slug): View
    {
        $proiect = Proiect::where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('site.proiect', compact('proiect'));
    }

    public function blog(): View
    {
        $articole = Articol::where('is_published', true)->orderByDesc('published_at')->paginate(10);

        return view('site.blog', compact('articole'));
    }

    public function articol(string $slug): View
    {
        $articol = Articol::where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('site.articol', compact('articol'));
    }

    public function contact(): View
    {
        return view('site.contact');
    }

    public function dateFirma(): View
    {
        $pagina = Pagina::where('slug', 'date-firma')->where('is_published', true)->first();

        return view('site.date-firma', compact('pagina'));
    }

    public function legalPage(string $slug): View
    {
        $pagina = Pagina::where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('site.legal', compact('pagina'));
    }
}
