<?php

namespace App\Filament\Resources\Localitates;

use App\Filament\Resources\Localitates\Pages\CreateLocalitate;
use App\Filament\Resources\Localitates\Pages\EditLocalitate;
use App\Filament\Resources\Localitates\Pages\ListLocalitates;
use App\Filament\Resources\Localitates\Schemas\LocalitateForm;
use App\Filament\Resources\Localitates\Tables\LocalitatesTable;
use App\Models\Localitate;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LocalitateResource extends Resource
{
    protected static ?string $model = Localitate::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Comert';

    protected static ?string $navigationLabel = 'Localitati (landing)';

    protected static ?string $modelLabel = 'Localitate';

    protected static ?string $pluralModelLabel = 'Localitati';

    protected static ?int $navigationSort = 25;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMapPin;

    public static function form(Schema $schema): Schema
    {
        return LocalitateForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LocalitatesTable::configure($table);
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
            'index' => ListLocalitates::route('/'),
            'create' => CreateLocalitate::route('/create'),
            'edit' => EditLocalitate::route('/{record}/edit'),
        ];
    }
}
