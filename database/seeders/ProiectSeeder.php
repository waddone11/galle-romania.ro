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
                'slug'         => 'parcul-central-buftea-amenajare',
                'titlu'        => ['ro' => 'Amenajare parcul central Buftea', 'de' => null, 'en' => null],
                'descriere'    => ['ro' => 'Refacerea aleilor, plantare arbori autohtoni, intretinere periodica.', 'de' => null, 'en' => null],
                'continut'     => ['ro' => 'Proiect derulat pentru primaria Buftea — 1.2 ha refacute integral, 84 arbori autohtoni plantati (stejar, frasin, ulm), sistem de irigatie eficient.', 'de' => null, 'en' => null],
                'locatie'      => 'Buftea, Ilfov',
                'an'           => 2024,
                'categorie'    => 'peisagistica',
                'is_published' => true,
                'ordine'       => 10,
            ],
            [
                'slug'         => 'gestiune-padure-domeniu-prahova',
                'titlu'        => ['ro' => 'Plan de gestiune padure privata — domeniu Prahova', 'de' => null, 'en' => null],
                'descriere'    => ['ro' => 'Plan multianual de recoltari + regenerare naturala pe 40 ha.', 'de' => null, 'en' => null],
                'continut'     => ['ro' => 'Pentru un proprietar privat, am elaborat planul tehnico-economic pe 10 ani: zone protejate, rotatie recoltari, regenerare naturala asistata, monitorizare biodiversitate.', 'de' => null, 'en' => null],
                'locatie'      => 'Comuna Provita de Sus, Prahova',
                'an'           => 2023,
                'categorie'    => 'forestier',
                'is_published' => true,
                'ordine'       => 20,
            ],
            [
                'slug'         => 'platforma-compostare-magurele',
                'titlu'        => ['ro' => 'Platforma de compostare Magurele', 'de' => null, 'en' => null],
                'descriere'    => ['ro' => 'Statie de compostare deseuri verzi cu capacitate 500 t/an.', 'de' => null, 'en' => null],
                'continut'     => ['ro' => 'Studiu de fezabilitate + executie pentru o platforma de compostare destinata deseurilor verzi din spatiile publice. Procese aliniate cu standardele Galle GmbH.', 'de' => null, 'en' => null],
                'locatie'      => 'Magurele, Ilfov',
                'an'           => 2023,
                'categorie'    => 'compostare',
                'is_published' => true,
                'ordine'       => 30,
            ],
        ];

        foreach ($rows as $row) {
            Proiect::updateOrCreate(['slug' => $row['slug']], $row);
        }
    }
}
