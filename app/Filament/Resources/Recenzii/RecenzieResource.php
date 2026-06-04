<?php

namespace App\Filament\Resources\Recenzii;

use App\Filament\Resources\Recenzii\Pages\CreateRecenzie;
use App\Filament\Resources\Recenzii\Pages\EditRecenzie;
use App\Filament\Resources\Recenzii\Pages\ListRecenzii;
use App\Filament\Resources\Recenzii\Schemas\RecenzieForm;
use App\Filament\Resources\Recenzii\Tables\RecenziiTable;
use App\Models\Recenzie;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RecenzieResource extends Resource
{
    protected static ?string $model = Recenzie::class;

    protected static ?string $slug = 'recenzii';

    protected static \UnitEnum|string|null $navigationGroup = 'Continut';

    protected static ?string $navigationLabel = 'Recenzii';

    protected static ?string $modelLabel = 'Recenzie';

    protected static ?string $pluralModelLabel = 'Recenzii';

    protected static ?int $navigationSort = 65;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedStar;

    public static function form(Schema $schema): Schema
    {
        return RecenzieForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RecenziiTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRecenzii::route('/'),
            'create' => CreateRecenzie::route('/create'),
            'edit' => EditRecenzie::route('/{record}/edit'),
        ];
    }
}
