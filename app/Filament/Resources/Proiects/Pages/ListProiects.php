<?php

namespace App\Filament\Resources\Proiects\Pages;

use App\Filament\Resources\Proiects\ProiectResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProiects extends ListRecords
{
    protected static string $resource = ProiectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
