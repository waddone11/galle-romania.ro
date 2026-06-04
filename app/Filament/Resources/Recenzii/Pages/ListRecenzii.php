<?php

namespace App\Filament\Resources\Recenzii\Pages;

use App\Filament\Resources\Recenzii\RecenzieResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRecenzii extends ListRecords
{
    protected static string $resource = RecenzieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
