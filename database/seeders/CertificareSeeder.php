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
                'nume' => 'FSC',
                'slug' => 'fsc',
                'logo' => '/images/certificari/fsc.svg',
                'tip' => CertificareTip::Fsc,
                'status' => CertificareStatus::InProces,
                'emitent' => 'Forest Stewardship Council',
                'detinator' => null,
                'descriere' => [
                    'ro' => 'Certificare in proces — vizeaza trasabilitatea lemnului si gestionarea responsabila a padurii.',
                    'de' => 'Zertifizierung läuft — Schwerpunkt: Rückverfolgbarkeit des Holzes und verantwortungsvolle Waldbewirtschaftung.',
                    'en' => 'Certification in progress — focused on timber traceability and responsible forest management.',
                ],
                'is_active' => true,
                'ordine' => 10,
            ],
            [
                'nume' => 'PEFC',
                'slug' => 'pefc',
                'logo' => '/images/certificari/pefc.png',
                'tip' => CertificareTip::Pefc,
                'status' => CertificareStatus::InProces,
                'emitent' => 'Programme for the Endorsement of Forest Certification',
                'detinator' => null,
                'descriere' => [
                    'ro' => 'Certificare in proces — focus pe gestionarea sustenabila a padurii la nivel european.',
                    'de' => 'Zertifizierung läuft — Fokus auf nachhaltiger Waldbewirtschaftung auf europäischer Ebene.',
                    'en' => 'Certification in progress — focused on sustainable forest management at European level.',
                ],
                'is_active' => true,
                'ordine' => 20,
            ],
            [
                'nume' => 'ISO 9001',
                'slug' => 'iso-9001',
                'logo' => '/images/certificari/iso-9001.svg',
                'tip' => CertificareTip::Iso9001,
                'status' => CertificareStatus::Activ,
                'emitent' => 'DEKRA',
                'detinator' => 'Galle GmbH',
                'descriere' => [
                    'ro' => 'Calitate — detinuta de Galle GmbH, partenerul nostru german.',
                    'de' => 'Qualität — gehalten von der Galle GmbH, unserem deutschen Partner.',
                    'en' => 'Quality — held by Galle GmbH, our German partner.',
                ],
                'is_active' => true,
                'ordine' => 30,
            ],
            [
                'nume' => 'ISO 14001',
                'slug' => 'iso-14001',
                'logo' => '/images/certificari/iso-14001.svg',
                'tip' => CertificareTip::Iso14001,
                'status' => CertificareStatus::Activ,
                'emitent' => 'DEKRA',
                'detinator' => 'Galle GmbH',
                'descriere' => [
                    'ro' => 'Mediu — managementul impactului ecologic. Detinuta de Galle GmbH.',
                    'de' => 'Umwelt — Management der ökologischen Auswirkungen. Gehalten von der Galle GmbH.',
                    'en' => 'Environment — managing ecological impact. Held by Galle GmbH.',
                ],
                'is_active' => true,
                'ordine' => 40,
            ],
            [
                'nume' => 'RAL',
                'slug' => 'ral',
                'logo' => '/images/certificari/ral.svg',
                'tip' => CertificareTip::Ral,
                'status' => CertificareStatus::Activ,
                'emitent' => 'RAL Deutsches Institut fur Gutesicherung und Kennzeichnung',
                'detinator' => 'Galle GmbH',
                'descriere' => [
                    'ro' => 'Sigiliu de calitate german — detinut de Galle GmbH.',
                    'de' => 'Deutsches Gütesiegel — gehalten von der Galle GmbH.',
                    'en' => 'German quality seal — held by Galle GmbH.',
                ],
                'is_active' => true,
                'ordine' => 50,
            ],
            [
                'nume' => 'DEKRA',
                'slug' => 'dekra',
                'logo' => '/images/certificari/dekra.svg',
                'tip' => CertificareTip::Dekra,
                'status' => CertificareStatus::Activ,
                'emitent' => 'DEKRA SE',
                'detinator' => 'Galle GmbH',
                'descriere' => [
                    'ro' => 'Certificare independenta — Galle GmbH a fost auditat de DEKRA pentru procesele sale.',
                    'de' => 'Unabhängige Zertifizierung — die Prozesse der Galle GmbH wurden von DEKRA auditiert.',
                    'en' => 'Independent certification — Galle GmbH has been audited by DEKRA for its processes.',
                ],
                'is_active' => true,
                'ordine' => 60,
            ],
        ];

        foreach ($rows as $row) {
            Certificare::updateOrCreate(['slug' => $row['slug']], $row);
        }
    }
}
