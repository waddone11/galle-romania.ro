<?php

namespace App\Filament\Resources\Membri\Pages;

use App\Filament\Resources\Membri\MembruResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMembri extends ListRecords
{
    protected static string $resource = MembruResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
