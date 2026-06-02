<?php

namespace App\Filament\Resources\Leads\Tables;

use App\Enums\ComandaStatus;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LeadsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('created_at')->label('Primit')->dateTime('d.m.Y H:i')->sortable(),
                TextColumn::make('nume')->searchable(),
                TextColumn::make('firma')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('telefon')->toggleable(),
                TextColumn::make('serviciu')->badge()->color('gray'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (?ComandaStatus $state) => $state?->color()),
            ])
            ->filters([
                SelectFilter::make('status')->options(ComandaStatus::class),
                SelectFilter::make('serviciu')
                    ->options([
                        'forestier' => 'Forestier',
                        'peisagistica' => 'Peisagistica',
                        'compostare' => 'Compostare',
                    ]),
            ])
            ->recordActions([
                EditAction::make()->label('Actualizeaza status'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([]),
            ]);
    }
}
