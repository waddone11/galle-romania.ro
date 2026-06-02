<?php

namespace App\Filament\Resources\Certificares\Pages;

use App\Filament\Resources\Certificares\CertificareResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCertificare extends EditRecord
{
    protected static string $resource = CertificareResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
