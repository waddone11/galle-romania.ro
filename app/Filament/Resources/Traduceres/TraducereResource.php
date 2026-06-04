<?php

namespace App\Filament\Resources\Traduceres;

use App\Filament\Resources\Traduceres\Pages\CreateTraducere;
use App\Filament\Resources\Traduceres\Pages\EditTraducere;
use App\Filament\Resources\Traduceres\Pages\ListTraduceres;
use App\Filament\Resources\Traduceres\Schemas\TraducereForm;
use App\Filament\Resources\Traduceres\Tables\TraduceresTable;
use App\Models\Traducere;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TraducereResource extends Resource
{
    protected static ?string $model = Traducere::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Continut';

    protected static ?string $navigationLabel = 'Traduceri';

    protected static ?string $modelLabel = 'Traducere';

    protected static ?string $pluralModelLabel = 'Traduceri';

    protected static ?int $navigationSort = 70;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedLanguage;

    public static function form(Schema $schema): Schema
    {
        return TraducereForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TraduceresTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTraduceres::route('/'),
            'create' => CreateTraducere::route('/create'),
            'edit' => EditTraducere::route('/{record}/edit'),
        ];
    }
}
