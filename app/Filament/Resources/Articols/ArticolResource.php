<?php

namespace App\Filament\Resources\Articols;

use App\Filament\Resources\Articols\Pages\CreateArticol;
use App\Filament\Resources\Articols\Pages\EditArticol;
use App\Filament\Resources\Articols\Pages\ListArticols;
use App\Filament\Resources\Articols\Schemas\ArticolForm;
use App\Filament\Resources\Articols\Tables\ArticolsTable;
use App\Models\Articol;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ArticolResource extends Resource
{
    protected static ?string $model = Articol::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Continut';

    protected static ?string $navigationLabel = 'Articole (Blog)';

    protected static ?string $modelLabel = 'Articol';

    protected static ?string $pluralModelLabel = 'Articole';

    protected static ?int $navigationSort = 50;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ArticolForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ArticolsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListArticols::route('/'),
            'create' => CreateArticol::route('/create'),
            'edit' => EditArticol::route('/{record}/edit'),
        ];
    }
}
