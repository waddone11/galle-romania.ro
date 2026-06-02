<?php

namespace App\Filament\Resources\Certificares\Pages;

use App\Filament\Resources\Certificares\CertificareResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCertificares extends ListRecords
{
    protected static string $resource = CertificareResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
