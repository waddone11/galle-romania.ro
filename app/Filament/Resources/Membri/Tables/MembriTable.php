<?php

namespace App\Filament\Resources\Membri\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MembriTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('ordine')
            ->columns([
                ImageColumn::make('imagine')
                    ->label('Poza')
                    ->circular(),
                TextColumn::make('nume')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('rol')
                    ->label('Rol')
                    ->formatStateUsing(fn ($record) => $record?->getTranslation('rol', 'ro')),
                IconColumn::make('is_active')->label('Activ')->boolean(),
                TextColumn::make('ordine')->sortable(),
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
