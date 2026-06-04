<?php

namespace Database\Seeders;

use App\Enums\ServiciuAudienta;
use App\Enums\ServiciuCategorie;
use App\Models\Serviciu;
use Illuminate\Database\Seeder;

class ServiciuSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'slug' => 'servicii-forestiere',
                'titlu' => ['ro' => 'Servicii forestiere', 'de' => 'Forstdienstleistungen', 'en' => 'Forestry services'],
                'descriere' => [
                    'ro' => 'Gestionam padurea proprietarilor privati, primarilor si companiilor — planificare, recoltare, regenerare.',
                    'de' => 'Wir bewirtschaften die Wälder privater Eigentümer, Gemeinden und Unternehmen — Planung, Holzernte, Verjüngung.',
                    'en' => 'We manage forests for private owners, municipalities and companies — planning, harvesting, regeneration.',
                ],
                'continut' => [
                    'ro' => 'Echipa Galle Silva ofera consultanta tehnica, evaluare arbori, planificare recoltari, transport si regenerare. Lucram pe baza standardelor Galle GmbH si urmarim regenerarea naturala unde e posibil.',
                    'de' => 'Das Team von Galle Silva bietet technische Beratung, Baumbewertung, Ernteplanung, Transport und Verjüngung. Wir arbeiten nach den Standards der Galle GmbH und setzen, wo möglich, auf natürliche Verjüngung.',
                    'en' => 'The Galle Silva team provides technical consulting, tree assessment, harvest planning, transport and regeneration. We work to Galle GmbH standards and favour natural regeneration wherever possible.',
                ],
                'categorie' => ServiciuCategorie::Forestier,
                'audienta' => ServiciuAudienta::Ambele,
                'is_active' => true,
                'ordine' => 10,
            ],
            [
                'slug' => 'peisagistica',
                'titlu' => ['ro' => 'Peisagistica', 'de' => 'Landschaftsbau', 'en' => 'Landscaping'],
                'descriere' => [
                    'ro' => 'Amenajari de spatii verzi pentru primarii, institutii si companii. Proiectare + executie + mentenanta.',
                    'de' => 'Grünflächengestaltung für Gemeinden, Institutionen und Unternehmen. Planung + Ausführung + Pflege.',
                    'en' => 'Green-space landscaping for municipalities, institutions and companies. Design + execution + maintenance.',
                ],
                'continut' => [
                    'ro' => 'De la concept la mentenanta — Galle Silva amenajeaza parcuri, gradini institutionale si zone verzi industriale.',
                    'de' => 'Vom Konzept bis zur Pflege — Galle Silva gestaltet Parks, institutionelle Gärten und industrielle Grünflächen.',
                    'en' => 'From concept to maintenance — Galle Silva creates parks, institutional gardens and industrial green areas.',
                ],
                'categorie' => ServiciuCategorie::Peisagistica,
                'audienta' => ServiciuAudienta::Institutie,
                'is_active' => true,
                'ordine' => 20,
            ],
            [
                'slug' => 'compostare',
                'titlu' => ['ro' => 'Compostare', 'de' => 'Kompostierung', 'en' => 'Composting'],
                'descriere' => [
                    'ro' => 'Compostare deseuri organice forestiere si agricole, conform standardelor germane Galle GmbH.',
                    'de' => 'Kompostierung organischer Abfälle aus Forst- und Landwirtschaft, nach den deutschen Standards der Galle GmbH.',
                    'en' => 'Composting of organic forestry and agricultural waste, to the German standards of Galle GmbH.',
                ],
                'continut' => [
                    'ro' => 'Procesul nostru de compostare transforma deseuri lemnoase si verzi in fertilizant organic, reducand presiunea pe gropile de gunoi si sustinand circuitul natural.',
                    'de' => 'Unser Kompostierungsprozess verwandelt Holz- und Grünabfälle in organischen Dünger — das entlastet die Deponien und unterstützt den natürlichen Kreislauf.',
                    'en' => 'Our composting process turns wood and green waste into organic fertiliser, easing the pressure on landfills and supporting the natural cycle.',
                ],
                'categorie' => ServiciuCategorie::Compostare,
                'audienta' => ServiciuAudienta::Ambele,
                'is_active' => true,
                'ordine' => 30,
            ],
        ];

        foreach ($rows as $row) {
            Serviciu::updateOrCreate(['slug' => $row['slug']], $row);
        }
    }
}
