<?php

namespace App\Filament\Resources\ComandaLemns\Pages;

use App\Filament\Resources\ComandaLemns\ComandaLemnResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditComandaLemn extends EditRecord
{
    protected static string $resource = ComandaLemnResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
