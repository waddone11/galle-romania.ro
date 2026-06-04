<?php

namespace App\Filament\Resources\Localitates\Pages;

use App\Filament\Resources\Localitates\LocalitateResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLocalitate extends EditRecord
{
    protected static string $resource = LocalitateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
