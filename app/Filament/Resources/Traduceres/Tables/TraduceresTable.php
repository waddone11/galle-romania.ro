<?php

namespace App\Filament\Resources\Traduceres\Tables;

use App\Models\Traducere;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TraduceresTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('cheie')
                    ->searchable()
                    ->limit(60)
                    ->sortable(),
                TextColumn::make('grup')
                    ->badge()
                    ->sortable(),
                TextColumn::make('valoare')
                    ->label('Valoare (RO)')
                    ->state(fn (Traducere $record): string => (string) $record->getTranslation('valoare', 'ro'))
                    ->limit(50),
                IconColumn::make('tradus_de')
                    ->label('DE')
                    ->boolean()
                    ->state(fn (Traducere $record): bool => filled($record->getTranslation('valoare', 'de', false))),
                IconColumn::make('tradus_en')
                    ->label('EN')
                    ->boolean()
                    ->state(fn (Traducere $record): bool => filled($record->getTranslation('valoare', 'en', false))),
            ])
            ->filters([
                SelectFilter::make('grup')
                    ->options([
                        'nav' => 'Navigatie',
                        'footer' => 'Footer',
                        'forms' => 'Formulare',
                        'blocks' => 'Block-uri',
                        'cookies' => 'Cookies',
                        'general' => 'General',
                    ]),
            ])
            ->defaultSort('grup')
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
