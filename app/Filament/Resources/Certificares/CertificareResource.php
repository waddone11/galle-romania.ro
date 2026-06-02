<?php

namespace App\Filament\Resources\Certificares;

use App\Filament\Resources\Certificares\Pages\CreateCertificare;
use App\Filament\Resources\Certificares\Pages\EditCertificare;
use App\Filament\Resources\Certificares\Pages\ListCertificares;
use App\Filament\Resources\Certificares\Schemas\CertificareForm;
use App\Filament\Resources\Certificares\Tables\CertificaresTable;
use App\Models\Certificare;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CertificareResource extends Resource
{
    protected static ?string $model = Certificare::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Configurare';

    protected static ?string $navigationLabel = 'Certificari';

    protected static ?string $modelLabel = 'Certificare';

    protected static ?string $pluralModelLabel = 'Certificari';

    protected static ?int $navigationSort = 70;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return CertificareForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CertificaresTable::configure($table);
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
            'index' => ListCertificares::route('/'),
            'create' => CreateCertificare::route('/create'),
            'edit' => EditCertificare::route('/{record}/edit'),
        ];
    }
}
