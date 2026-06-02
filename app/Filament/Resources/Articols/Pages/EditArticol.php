<?php

namespace App\Filament\Resources\Articols\Pages;

use App\Filament\Resources\Articols\ArticolResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditArticol extends EditRecord
{
    protected static string $resource = ArticolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
