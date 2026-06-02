<?php

namespace App\Filament\Resources\ComandaLemns\Tables;

use App\Enums\ComandaStatus;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ComandaLemnsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('created_at')->label('Primita')->dateTime('d.m.Y H:i')->sortable(),
                TextColumn::make('nume')->searchable(),
                TextColumn::make('telefon')->searchable(),
                TextColumn::make('localitate')->searchable(),
                TextColumn::make('specie.nume')
                    ->label('Specie')
                    ->formatStateUsing(fn ($record) => $record->specie?->getTranslation('nume', 'ro')),
                TextColumn::make('cantitate')->numeric(2)->sortable(),
                TextColumn::make('unitate')->badge(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (?ComandaStatus $state) => $state?->color()),
                TextColumn::make('source')->badge()->color('gray')->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')->options(ComandaStatus::class),
            ])
            ->recordActions([
                EditAction::make()->label('Actualizeaza status'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([]),
            ]);
    }
}
