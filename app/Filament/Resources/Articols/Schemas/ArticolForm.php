<?php

namespace App\Filament\Resources\Articols\Schemas;

use App\Filament\Concerns\HasTranslatableTabs;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ArticolForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Continut traductibil')
                ->schema([
                    HasTranslatableTabs::for(fn (string $loc, string $label) => [
                        TextInput::make("titlu.$loc")
                            ->label("Titlu ($label)")
                            ->required($loc === 'ro')
                            ->live(onBlur: $loc === 'ro')
                            ->afterStateUpdated(fn ($state, callable $set) => $loc === 'ro' && $set('slug', Str::slug((string) $state))),
                        Textarea::make("excerpt.$loc")
                            ->label("Excerpt ($label)")
                            ->rows(2),
                        Textarea::make("continut.$loc")
                            ->label("Continut ($label)")
                            ->rows(8),
                    ]),
                ]),

            Section::make('Publicare')
                ->columns(3)
                ->schema([
                    TextInput::make('slug')->required()->unique(ignoreRecord: true)->columnSpan(3),
                    TextInput::make('categorie')->placeholder('ghid / studiu / noutati'),
                    DateTimePicker::make('published_at')->default(now()),
                    Toggle::make('is_published')->default(false),
                    TextInput::make('imagine')->label('URL imagine')->columnSpan(3),
                ]),
        ]);
    }
}
