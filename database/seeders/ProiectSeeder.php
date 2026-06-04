<?php

namespace Database\Seeders;

use App\Models\Proiect;
use Illuminate\Database\Seeder;

class ProiectSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'slug' => 'parcul-central-buftea-amenajare',
                'titlu' => [
                    'ro' => 'Amenajare parcul central Buftea',
                    'de' => 'Gestaltung des Zentralparks Buftea',
                    'en' => 'Buftea central park landscaping',
                ],
                'descriere' => [
                    'ro' => 'Refacerea aleilor, plantare arbori autohtoni, intretinere periodica.',
                    'de' => 'Sanierung der Wege, Pflanzung heimischer Bäume, regelmäßige Pflege.',
                    'en' => 'Path restoration, planting of native trees, regular maintenance.',
                ],
                'continut' => [
                    'ro' => 'Proiect derulat pentru primaria Buftea — 1.2 ha refacute integral, 84 arbori autohtoni plantati (stejar, frasin, ulm), sistem de irigatie eficient.',
                    'de' => 'Projekt für die Stadtverwaltung Buftea — 1,2 ha vollständig saniert, 84 heimische Bäume gepflanzt (Eiche, Esche, Ulme), effizientes Bewässerungssystem.',
                    'en' => 'Project carried out for Buftea town hall — 1.2 ha fully restored, 84 native trees planted (oak, ash, elm), efficient irrigation system.',
                ],
                'locatie' => 'Buftea, Ilfov',
                'an' => 2024,
                'categorie' => 'peisagistica',
                'is_published' => true,
                'ordine' => 10,
            ],
            [
                'slug' => 'gestiune-padure-domeniu-prahova',
                'titlu' => [
                    'ro' => 'Plan de gestiune padure privata — domeniu Prahova',
                    'de' => 'Bewirtschaftungsplan für einen Privatwald — Gut in Prahova',
                    'en' => 'Private forest management plan — Prahova estate',
                ],
                'descriere' => [
                    'ro' => 'Plan multianual de recoltari + regenerare naturala pe 40 ha.',
                    'de' => 'Mehrjähriger Ernteplan + natürliche Verjüngung auf 40 ha.',
                    'en' => 'Multi-year harvesting plan + natural regeneration across 40 ha.',
                ],
                'continut' => [
                    'ro' => 'Pentru un proprietar privat, am elaborat planul tehnico-economic pe 10 ani: zone protejate, rotatie recoltari, regenerare naturala asistata, monitorizare biodiversitate.',
                    'de' => 'Für einen privaten Eigentümer haben wir den technisch-wirtschaftlichen 10-Jahres-Plan erarbeitet: Schutzzonen, Erntenrotation, unterstützte natürliche Verjüngung, Biodiversitätsmonitoring.',
                    'en' => 'For a private owner, we drew up the 10-year technical and economic plan: protected zones, harvest rotation, assisted natural regeneration, biodiversity monitoring.',
                ],
                'locatie' => 'Comuna Provita de Sus, Prahova',
                'an' => 2023,
                'categorie' => 'forestier',
                'is_published' => true,
                'ordine' => 20,
            ],
            [
                'slug' => 'platforma-compostare-magurele',
                'titlu' => [
                    'ro' => 'Platforma de compostare Magurele',
                    'de' => 'Kompostieranlage Magurele',
                    'en' => 'Magurele composting facility',
                ],
                'descriere' => [
                    'ro' => 'Statie de compostare deseuri verzi cu capacitate 500 t/an.',
                    'de' => 'Kompostieranlage für Grünabfälle mit einer Kapazität von 500 t/Jahr.',
                    'en' => 'Green-waste composting station with a 500 t/year capacity.',
                ],
                'continut' => [
                    'ro' => 'Studiu de fezabilitate + executie pentru o platforma de compostare destinata deseurilor verzi din spatiile publice. Procese aliniate cu standardele Galle GmbH.',
                    'de' => 'Machbarkeitsstudie + Ausführung einer Kompostieranlage für Grünabfälle aus öffentlichen Flächen. Prozesse nach den Standards der Galle GmbH.',
                    'en' => 'Feasibility study + execution of a composting facility for green waste from public spaces. Processes aligned with Galle GmbH standards.',
                ],
                'locatie' => 'Magurele, Ilfov',
                'an' => 2023,
                'categorie' => 'compostare',
                'is_published' => true,
                'ordine' => 30,
            ],
        ];

        foreach ($rows as $row) {
            Proiect::updateOrCreate(['slug' => $row['slug']], $row);
        }

        $this->attachGalerie();
    }

    /**
     * Ataseaza idempotent poze reale (din public/images/galle/proiecte) la colectia
     * medialibrary `galerie`. `preservingOriginal` pastreaza fisierele sursa in git;
     * copiile medialibrary ajung pe discul `public` (storage/app/public).
     */
    private function attachGalerie(): void
    {
        $galerii = [
            'parcul-central-buftea-amenajare' => ['forwarder-drum.jpg', 'gramada-busteni.jpg'],
            'gestiune-padure-domeniu-prahova' => ['harvester-lucru.jpg', 'busteni-marcati.jpg', 'harvester-galle.jpg'],
            'platforma-compostare-magurele' => ['depozit-utilaj.jpg', 'depozit-amurg.jpg', 'camion-incarcat.jpg'],
        ];

        foreach ($galerii as $slug => $fisiere) {
            $proiect = Proiect::where('slug', $slug)->first();

            if (! $proiect || $proiect->getMedia('galerie')->isNotEmpty()) {
                continue;
            }

            foreach ($fisiere as $fisier) {
                $cale = public_path('images/galle/proiecte/'.$fisier);

                if (is_file($cale)) {
                    $proiect->addMedia($cale)->preservingOriginal()->toMediaCollection('galerie');
                }
            }
        }
    }
}
