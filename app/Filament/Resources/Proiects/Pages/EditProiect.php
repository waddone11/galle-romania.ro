<?php

namespace App\Filament\Resources\Proiects\Pages;

use App\Filament\Resources\Proiects\ProiectResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProiect extends EditRecord
{
    protected static string $resource = ProiectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
