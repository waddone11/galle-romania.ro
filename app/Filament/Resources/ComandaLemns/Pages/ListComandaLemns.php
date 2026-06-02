<?php

namespace App\Filament\Resources\ComandaLemns\Pages;

use App\Filament\Resources\ComandaLemns\ComandaLemnResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListComandaLemns extends ListRecords
{
    protected static string $resource = ComandaLemnResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
