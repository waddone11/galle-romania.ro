<?php

namespace App\Filament\Resources\Species\Pages;

use App\Filament\Resources\Species\SpecieResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSpecie extends EditRecord
{
    protected static string $resource = SpecieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
