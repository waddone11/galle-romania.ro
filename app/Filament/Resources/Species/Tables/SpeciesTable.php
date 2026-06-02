<?php

namespace App\Filament\Resources\Species\Tables;

use App\Enums\SpecieStatus;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SpeciesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('ordine')
            ->columns([
                TextColumn::make('nume')
                    ->label('Nume')
                    ->formatStateUsing(fn ($record) => $record?->getTranslation('nume', 'ro'))
                    ->searchable(query: fn ($query, $search) => $query->where('nume', 'like', "%$search%"))
                    ->sortable(),
                TextColumn::make('slug')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (?SpecieStatus $state) => $state?->color()),
                TextColumn::make('pret_pornire')->money('RON')->sortable(),
                TextColumn::make('unitate')->badge(),
                TextColumn::make('putere_calorica')->suffix(' kWh/kg')->sortable(),
                IconColumn::make('is_active')->label('Activ')->boolean(),
                TextColumn::make('ordine')->sortable()->toggleable(),
            ])
            ->filters([
                SelectFilter::make('status')->options(SpecieStatus::class),
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
