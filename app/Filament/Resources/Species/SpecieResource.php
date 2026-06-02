<?php

namespace App\Filament\Resources\Species;

use App\Filament\Resources\Species\Pages\CreateSpecie;
use App\Filament\Resources\Species\Pages\EditSpecie;
use App\Filament\Resources\Species\Pages\ListSpecies;
use App\Filament\Resources\Species\Schemas\SpecieForm;
use App\Filament\Resources\Species\Tables\SpeciesTable;
use App\Models\Specie;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SpecieResource extends Resource
{
    protected static ?string $model = Specie::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Comert';

    protected static ?string $navigationLabel = 'Specii lemn';

    protected static ?string $modelLabel = 'Specie';

    protected static ?string $pluralModelLabel = 'Specii';

    protected static ?int $navigationSort = 10;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return SpecieForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SpeciesTable::configure($table);
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
            'index' => ListSpecies::route('/'),
            'create' => CreateSpecie::route('/create'),
            'edit' => EditSpecie::route('/{record}/edit'),
        ];
    }
}
