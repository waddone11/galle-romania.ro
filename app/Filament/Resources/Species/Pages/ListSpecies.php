<?php

namespace App\Filament\Resources\Species\Pages;

use App\Filament\Resources\Species\SpecieResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSpecies extends ListRecords
{
    protected static string $resource = SpecieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
