<?php

namespace App\Filament\Resources\Servicius;

use App\Filament\Resources\Servicius\Pages\CreateServiciu;
use App\Filament\Resources\Servicius\Pages\EditServiciu;
use App\Filament\Resources\Servicius\Pages\ListServicius;
use App\Filament\Resources\Servicius\Schemas\ServiciuForm;
use App\Filament\Resources\Servicius\Tables\ServiciusTable;
use App\Models\Serviciu;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ServiciuResource extends Resource
{
    protected static ?string $model = Serviciu::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Continut';

    protected static ?string $navigationLabel = 'Servicii';

    protected static ?string $modelLabel = 'Serviciu';

    protected static ?string $pluralModelLabel = 'Servicii';

    protected static ?int $navigationSort = 30;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ServiciuForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiciusTable::configure($table);
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
            'index' => ListServicius::route('/'),
            'create' => CreateServiciu::route('/create'),
            'edit' => EditServiciu::route('/{record}/edit'),
        ];
    }
}
