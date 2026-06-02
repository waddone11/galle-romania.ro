<?php

namespace App\Http\Controllers;

use App\Models\Articol;
use App\Models\Certificare;
use App\Models\Faq;
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

        return view('site.home', compact('species', 'servicii', 'certificari', 'articole'));
    }

    public function lemnDeFoc(): View
    {
        $species = Specie::where('is_active', true)->orderBy('ordine')->get();
        $zone = ZonaLivrare::where('is_active', true)->orderBy('ordine')->get();
        $faqs = Faq::where('is_published', true)->where('categorie', 'lemn_de_foc')->orderBy('ordine')->get();

        return view('site.lemn-de-foc', compact('species', 'zone', 'faqs'));
    }

    public function servicii(?string $categorie = null): View
    {
        $query = Serviciu::where('is_active', true)->orderBy('ordine');

        if ($categorie && in_array($categorie, ['forestiere', 'peisagistica', 'compostare'], true)) {
            $catMap = ['forestiere' => 'forestier', 'peisagistica' => 'peisagistica', 'compostare' => 'compostare'];
            $query->where('categorie', $catMap[$categorie]);
        }

        return view('site.servicii', [
            'servicii' => $query->get(),
            'activeCategorie' => $categorie,
        ]);
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

        return view('site.certificari', compact('certificari'));
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

    public function legalPage(string $slug): View
    {
        $pagina = Pagina::where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('site.legal', compact('pagina'));
    }
}
