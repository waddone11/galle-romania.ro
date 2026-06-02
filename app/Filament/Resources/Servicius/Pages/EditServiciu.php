<?php

namespace App\Filament\Resources\Servicius\Pages;

use App\Filament\Resources\Servicius\ServiciuResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditServiciu extends EditRecord
{
    protected static string $resource = ServiciuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
