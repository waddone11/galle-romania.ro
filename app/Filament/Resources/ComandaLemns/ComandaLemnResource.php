<?php

namespace App\Filament\Resources\ComandaLemns;

use App\Filament\Resources\ComandaLemns\Pages\EditComandaLemn;
use App\Filament\Resources\ComandaLemns\Pages\ListComandaLemns;
use App\Filament\Resources\ComandaLemns\Schemas\ComandaLemnForm;
use App\Filament\Resources\ComandaLemns\Tables\ComandaLemnsTable;
use App\Models\ComandaLemn;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ComandaLemnResource extends Resource
{
    protected static ?string $model = ComandaLemn::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Comert';

    protected static ?string $navigationLabel = 'Comenzi lemn';

    protected static ?string $modelLabel = 'Comanda';

    protected static ?string $pluralModelLabel = 'Comenzi lemn';

    protected static ?int $navigationSort = 5;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingCart;

    public static function canCreate(): bool
    {
        // Comenzile vin doar din site-ul public (calculator, form, WhatsApp) —
        // operatorii actualizeaza doar statusul, nu creeaza manual.
        return false;
    }

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::query()->where('status', 'nou')->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function form(Schema $schema): Schema
    {
        return ComandaLemnForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ComandaLemnsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListComandaLemns::route('/'),
            'edit'  => EditComandaLemn::route('/{record}/edit'),
        ];
    }
}
