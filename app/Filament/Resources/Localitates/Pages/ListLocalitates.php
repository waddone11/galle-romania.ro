<?php

namespace App\Filament\Resources\Localitates\Pages;

use App\Filament\Resources\Localitates\LocalitateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLocalitates extends ListRecords
{
    protected static string $resource = LocalitateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
