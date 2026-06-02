<?php

namespace App\Filament\Resources\ZonaLivrares;

use App\Filament\Resources\ZonaLivrares\Pages\CreateZonaLivrare;
use App\Filament\Resources\ZonaLivrares\Pages\EditZonaLivrare;
use App\Filament\Resources\ZonaLivrares\Pages\ListZonaLivrares;
use App\Filament\Resources\ZonaLivrares\Schemas\ZonaLivrareForm;
use App\Filament\Resources\ZonaLivrares\Tables\ZonaLivraresTable;
use App\Models\ZonaLivrare;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ZonaLivrareResource extends Resource
{
    protected static ?string $model = ZonaLivrare::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Comert';

    protected static ?string $navigationLabel = 'Zone livrare';

    protected static ?string $modelLabel = 'Zona livrare';

    protected static ?string $pluralModelLabel = 'Zone livrare';

    protected static ?int $navigationSort = 20;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ZonaLivrareForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ZonaLivraresTable::configure($table);
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
            'index' => ListZonaLivrares::route('/'),
            'create' => CreateZonaLivrare::route('/create'),
            'edit' => EditZonaLivrare::route('/{record}/edit'),
        ];
    }
}
