<?php

namespace App\Filament\Resources\Membri\Pages;

use App\Filament\Resources\Membri\MembruResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMembru extends EditRecord
{
    protected static string $resource = MembruResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
