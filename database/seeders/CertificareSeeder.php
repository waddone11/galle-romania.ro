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
                    'ro' => 'Forest Stewardship Council — standard internațional pentru gestionarea responsabilă a pădurilor și trasabilitatea lemnului. Galle Silva este în proces de certificare FSC.',
                    'de' => 'Forest Stewardship Council — internationaler Standard für verantwortungsvolle Waldbewirtschaftung und die Rückverfolgbarkeit des Holzes. Galle Silva befindet sich im FSC-Zertifizierungsprozess.',
                    'en' => 'Forest Stewardship Council — international standard for responsible forest management and timber traceability. Galle Silva is in the process of FSC certification.',
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
                    'ro' => 'Programme for the Endorsement of Forest Certification — sistem internațional pentru gestionarea durabilă a pădurilor. În proces de certificare.',
                    'de' => 'Programme for the Endorsement of Forest Certification — internationales System für nachhaltige Waldbewirtschaftung. Im Zertifizierungsprozess.',
                    'en' => 'Programme for the Endorsement of Forest Certification — international system for sustainable forest management. Certification in progress.',
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
                    'ro' => 'Standard internațional pentru sisteme de management al calității. Certificare deținută de grupul Galle GmbH.',
                    'de' => 'Internationale Norm für Qualitätsmanagementsysteme. Zertifizierung gehalten von der Galle GmbH Gruppe.',
                    'en' => 'International standard for quality management systems. Certification held by the Galle GmbH group.',
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
                    'ro' => 'Standard internațional pentru managementul de mediu. Certificare deținută de grupul Galle GmbH.',
                    'de' => 'Internationale Norm für Umweltmanagement. Zertifizierung gehalten von der Galle GmbH Gruppe.',
                    'en' => 'International standard for environmental management. Certification held by the Galle GmbH group.',
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
                    'ro' => 'Sigiliu de calitate RAL (Germania) pentru gestionarea pădurilor și a peisajului. Grupul Galle GmbH.',
                    'de' => 'RAL-Gütesiegel (Deutschland) für Wald- und Landschaftspflege. Galle GmbH Gruppe.',
                    'en' => 'RAL quality seal (Germany) for forest and landscape management. Galle GmbH group.',
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
                    'ro' => 'Certificare și audit independent DEKRA pentru procesele grupului. Grupul Galle GmbH.',
                    'de' => 'Unabhängige DEKRA-Zertifizierung und -Auditierung der Prozesse der Gruppe. Galle GmbH Gruppe.',
                    'en' => 'Independent DEKRA certification and audit of the group\'s processes. Galle GmbH group.',
                ],
                'is_active' => true,
                'ordine' => 60,
            ],
        ];

        foreach ($rows as $row) {
            $descriere = $row['descriere'];
            unset($row['descriere']);

            $cert = Certificare::updateOrCreate(['slug' => $row['slug']], $row);

            // Descrierea se completeaza doar daca lipseste pe limba respectiva —
            // editarile facute din admin nu sunt suprascrise la re-seed.
            foreach ($descriere as $locale => $text) {
                if (blank($cert->getTranslation('descriere', $locale, false))) {
                    $cert->setTranslation('descriere', $locale, $text);
                }
            }
            $cert->save();
        }
    }
}
