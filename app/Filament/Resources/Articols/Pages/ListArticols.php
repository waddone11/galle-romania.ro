<?php

namespace App\Filament\Resources\Articols\Pages;

use App\Filament\Resources\Articols\ArticolResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListArticols extends ListRecords
{
    protected static string $resource = ArticolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
