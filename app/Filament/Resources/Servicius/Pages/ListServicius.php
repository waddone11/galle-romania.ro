<?php

namespace App\Filament\Resources\Servicius\Pages;

use App\Filament\Resources\Servicius\ServiciuResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListServicius extends ListRecords
{
    protected static string $resource = ServiciuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
