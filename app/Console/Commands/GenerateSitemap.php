<?php

namespace App\Console\Commands;

use App\Models\Articol;
use App\Models\Localitate;
use App\Models\Pagina;
use App\Models\Proiect;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Genereaza public/sitemap.xml cu paginile publicate.';

    public function handle(): int
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY))
            ->add(Url::create('/lemn-de-foc')->setPriority(0.9)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY))
            ->add(Url::create('/servicii')->setPriority(0.8))
            ->add(Url::create('/servicii/exploatare-forestiera')->setPriority(0.7))
            ->add(Url::create('/servicii/achizitie-masa-lemnoasa')->setPriority(0.7))
            ->add(Url::create('/servicii/curatare-terenuri')->setPriority(0.7))
            ->add(Url::create('/servicii/transport-lemn')->setPriority(0.7))
            ->add(Url::create('/servicii/lucrari-silvice')->setPriority(0.7))
            ->add(Url::create('/institutii')->setPriority(0.7))
            ->add(Url::create('/despre')->setPriority(0.6))
            ->add(Url::create('/certificari')->setPriority(0.6))
            ->add(Url::create('/proiecte')->setPriority(0.6))
            ->add(Url::create('/blog')->setPriority(0.6))
            ->add(Url::create('/contact')->setPriority(0.5));

        Pagina::where('is_published', true)->get()->each(function (Pagina $p) use ($sitemap) {
            // Pagini acoperite explicit mai sus sau servite sub alt prefix (/servicii/...).
            $explicit = [
                'home', 'despre', 'institutii', 'certificari', 'servicii', 'lemn-de-foc',
                'exploatare-forestiera', 'achizitie-masa-lemnoasa', 'curatare-terenuri',
                'transport-lemn', 'lucrari-silvice',
            ];
            if (in_array($p->slug, $explicit, true)) {
                return;
            }
            $sitemap->add(Url::create("/{$p->slug}")->setPriority(0.4));
        });

        Localitate::where('is_active', true)->get()->each(function (Localitate $l) use ($sitemap) {
            $sitemap->add(Url::create("/lemn-de-foc/{$l->slug}")->setPriority(0.6));
        });

        Proiect::where('is_published', true)->get()->each(function (Proiect $p) use ($sitemap) {
            $sitemap->add(Url::create("/proiecte/{$p->slug}")->setPriority(0.5)->setLastModificationDate($p->updated_at));
        });

        Articol::where('is_published', true)->get()->each(function (Articol $a) use ($sitemap) {
            $sitemap->add(Url::create("/blog/{$a->slug}")->setPriority(0.5)->setLastModificationDate($a->updated_at));
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generat la public/sitemap.xml');

        return self::SUCCESS;
    }
}
