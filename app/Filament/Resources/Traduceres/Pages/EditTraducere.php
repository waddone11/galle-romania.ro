<?php

namespace App\Filament\Resources\Traduceres\Pages;

use App\Filament\Resources\Traduceres\TraducereResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTraducere extends EditRecord
{
    protected static string $resource = TraducereResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
