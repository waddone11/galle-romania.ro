<?php

namespace Database\Seeders;

use App\Enums\CertificareStatus;
use App\Enums\CertificareTip;
use App\Models\Certificare;
use Illuminate\Database\Seeder;

class CertificareSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'nume' => 'FSC — lant de custodie',
                'tip' => CertificareTip::Fsc,
                'status' => CertificareStatus::InProces,
                'emitent' => 'Forest Stewardship Council',
                'descriere' => ['ro' => 'Certificare in proces — vizeaza trasabilitatea lemnului si gestionarea responsabila a padurii.', 'de' => null, 'en' => null],
                'is_active' => true,
                'ordine' => 10,
            ],
            [
                'nume' => 'PEFC — lant de custodie',
                'tip' => CertificareTip::Pefc,
                'status' => CertificareStatus::InProces,
                'emitent' => 'Programme for the Endorsement of Forest Certification',
                'descriere' => ['ro' => 'Certificare in proces — focus pe gestionarea sustenabila a padurii la nivel european.', 'de' => null, 'en' => null],
                'is_active' => true,
                'ordine' => 20,
            ],
            [
                'nume' => 'ISO 9001 (Galle GmbH)',
                'tip' => CertificareTip::Iso9001,
                'status' => CertificareStatus::Activ,
                'emitent' => 'DEKRA',
                'descriere' => ['ro' => 'Calitate — detinuta de Galle GmbH, partenerul nostru german.', 'de' => null, 'en' => null],
                'is_active' => true,
                'ordine' => 30,
            ],
            [
                'nume' => 'ISO 14001 (Galle GmbH)',
                'tip' => CertificareTip::Iso14001,
                'status' => CertificareStatus::Activ,
                'emitent' => 'DEKRA',
                'descriere' => ['ro' => 'Mediu — managementul impactului ecologic. Detinuta de Galle GmbH.', 'de' => null, 'en' => null],
                'is_active' => true,
                'ordine' => 40,
            ],
            [
                'nume' => 'RAL (Galle GmbH)',
                'tip' => CertificareTip::Ral,
                'status' => CertificareStatus::Activ,
                'emitent' => 'RAL Deutsches Institut fur Gutesicherung und Kennzeichnung',
                'descriere' => ['ro' => 'Sigiliu de calitate german — detinut de Galle GmbH.', 'de' => null, 'en' => null],
                'is_active' => true,
                'ordine' => 50,
            ],
            [
                'nume' => 'DEKRA (Galle GmbH)',
                'tip' => CertificareTip::Dekra,
                'status' => CertificareStatus::Activ,
                'emitent' => 'DEKRA SE',
                'descriere' => ['ro' => 'Certificare independenta — Galle GmbH a fost auditat de DEKRA pentru procesele sale.', 'de' => null, 'en' => null],
                'is_active' => true,
                'ordine' => 60,
            ],
        ];

        foreach ($rows as $row) {
            Certificare::updateOrCreate(
                ['tip' => $row['tip']->value, 'nume' => $row['nume']],
                $row
            );
        }
    }
}
