<?php

namespace App\Filament\Resources\Membri;

use App\Filament\Resources\Membri\Pages\CreateMembru;
use App\Filament\Resources\Membri\Pages\EditMembru;
use App\Filament\Resources\Membri\Pages\ListMembri;
use App\Filament\Resources\Membri\Schemas\MembruForm;
use App\Filament\Resources\Membri\Tables\MembriTable;
use App\Models\Membru;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MembruResource extends Resource
{
    protected static ?string $model = Membru::class;

    protected static ?string $slug = 'membri';

    protected static \UnitEnum|string|null $navigationGroup = 'Continut';

    protected static ?string $navigationLabel = 'Echipa';

    protected static ?string $modelLabel = 'Membru';

    protected static ?string $pluralModelLabel = 'Membri';

    protected static ?int $navigationSort = 60;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    public static function form(Schema $schema): Schema
    {
        return MembruForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MembriTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMembri::route('/'),
            'create' => CreateMembru::route('/create'),
            'edit' => EditMembru::route('/{record}/edit'),
        ];
    }
}
