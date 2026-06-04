<?php

namespace App\Filament\Resources\Traduceres\Pages;

use App\Filament\Resources\Traduceres\TraducereResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTraduceres extends ListRecords
{
    protected static string $resource = TraducereResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
