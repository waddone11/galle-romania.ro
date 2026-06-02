<?php

namespace App\Filament\Resources\ZonaLivrares\Pages;

use App\Filament\Resources\ZonaLivrares\ZonaLivrareResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditZonaLivrare extends EditRecord
{
    protected static string $resource = ZonaLivrareResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
