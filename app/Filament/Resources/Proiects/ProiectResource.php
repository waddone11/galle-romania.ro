<?php

namespace App\Filament\Resources\Proiects;

use App\Filament\Resources\Proiects\Pages\CreateProiect;
use App\Filament\Resources\Proiects\Pages\EditProiect;
use App\Filament\Resources\Proiects\Pages\ListProiects;
use App\Filament\Resources\Proiects\Schemas\ProiectForm;
use App\Filament\Resources\Proiects\Tables\ProiectsTable;
use App\Models\Proiect;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProiectResource extends Resource
{
    protected static ?string $model = Proiect::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Continut';

    protected static ?string $navigationLabel = 'Proiecte';

    protected static ?string $modelLabel = 'Proiect';

    protected static ?string $pluralModelLabel = 'Proiecte';

    protected static ?int $navigationSort = 40;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ProiectForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProiectsTable::configure($table);
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
            'index' => ListProiects::route('/'),
            'create' => CreateProiect::route('/create'),
            'edit' => EditProiect::route('/{record}/edit'),
        ];
    }
}
