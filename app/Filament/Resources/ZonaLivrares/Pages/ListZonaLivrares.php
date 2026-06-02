<?php

namespace App\Filament\Resources\ZonaLivrares\Pages;

use App\Filament\Resources\ZonaLivrares\ZonaLivrareResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListZonaLivrares extends ListRecords
{
    protected static string $resource = ZonaLivrareResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
