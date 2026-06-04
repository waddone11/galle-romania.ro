<?php

namespace App\Filament\Resources\Recenzii\Tables;

use App\Models\Recenzie;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class RecenziiTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nume_client')->label('Client')->searchable(),
                TextColumn::make('localitate')->searchable(),
                TextColumn::make('rating')->numeric()->sortable(),
                TextColumn::make('serviciu'),
                IconColumn::make('is_published')->label('Publicata')->boolean(),
                TextColumn::make('data')->date()->sortable(),
                TextColumn::make('ordine')->numeric()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_published')->label('Publicata'),
                SelectFilter::make('serviciu')->options(Recenzie::SERVICII),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
