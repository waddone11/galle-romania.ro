<?php

namespace App\Filament\Resources\Recenzii\Pages;

use App\Filament\Resources\Recenzii\RecenzieResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRecenzie extends EditRecord
{
    protected static string $resource = RecenzieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
