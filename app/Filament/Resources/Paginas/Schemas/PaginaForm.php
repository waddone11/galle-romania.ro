<?php

namespace App\Filament\Resources\Paginas\Schemas;

use App\Filament\Concerns\HasTranslatableTabs;
use App\Models\Faq;
use App\Models\Recenzie;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PaginaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Identitate')
                ->columns(2)
                ->schema([
                    TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug((string) $state))),
                    Toggle::make('is_published')->default(true),
                    FileUpload::make('og_image')->image()->columnSpanFull(),
                    TextInput::make('ordine')->numeric()->default(0),
                ]),

            Section::make('Titlu si SEO (traductibile)')
                ->schema([
                    HasTranslatableTabs::for(fn (string $loc, string $label) => [
                        TextInput::make("titlu.$loc")->label("Titlu ($label)")->required($loc === 'ro'),
                        TextInput::make("meta_title.$loc")->label("Meta title ($label)"),
                        Textarea::make("meta_description.$loc")->label("Meta description ($label)")->rows(2),
                    ]),
                ]),

            Section::make('Continutul paginii (blocks)')
                ->description('Adauga blocuri in ordinea dorita. Textul din fiecare bloc are taburi RO/DE/EN.')
                ->schema([
                    Builder::make('sectiuni')
                        ->blocks(self::blocks())
                        ->collapsible()
                        ->collapsed()
                        ->columnSpanFull(),
                ]),
        ]);
    }

    /**
     * @return array<int, Block>
     */
    private static function blocks(): array
    {
        return [
            Block::make('hero')
                ->label('Hero (banner animat)')
                ->icon('heroicon-o-rectangle-stack')
                ->schema([
                    HasTranslatableTabs::for(fn (string $loc, string $label) => [
                        TextInput::make("badge.$loc")->label("Badge — text ($label)"),
                        TextInput::make("badge_link.$loc")->label("Badge — link text ($label)"),
                        TextInput::make("titlu.$loc")->label("Titlu ($label)"),
                        TextInput::make("subtitlu.$loc")->label("Subtitlu ($label)"),
                        TextInput::make("cta_text.$loc")->label("Text buton ($label)"),
                    ]),
                    TextInput::make('badge_url')->label('Badge — URL'),
                    TextInput::make('cta_url')->label('URL buton'),
                    Repeater::make('chips')
                        ->label('Carduri pe roata (orbit)')
                        ->schema([
                            Select::make('icon')
                                ->label('Icon')
                                ->options([
                                    'flacara' => 'Flacara (lemn de foc)',
                                    'copaci' => 'Copaci (exploatare forestiera)',
                                    'handshake' => 'Handshake (achizitie masa lemnoasa)',
                                    'excavator' => 'Excavator (curatare terenuri)',
                                    'frunza' => 'Frunza (certificare)',
                                    'camion' => 'Camion (livrare)',
                                ])
                                ->default('frunza')
                                ->required(),
                            HasTranslatableTabs::for(fn (string $loc, string $label) => [
                                TextInput::make("text.$loc")->label("Eticheta ($label)"),
                                TextInput::make("tooltip.$loc")->label("Descriere / tooltip ($label)"),
                            ]),
                        ])
                        ->defaultItems(0)
                        ->columnSpanFull(),
                ]),

            Block::make('header_pagina')
                ->label('Header pagina (H1 + intro)')
                ->icon('heroicon-o-h1')
                ->schema([
                    HasTranslatableTabs::for(fn (string $loc, string $label) => [
                        TextInput::make("titlu.$loc")->label("Titlu H1 ($label)"),
                        Textarea::make("intro.$loc")->label("Intro ($label)")->rows(3),
                    ]),
                    TextInput::make('imagine')
                        ->label('Imagine hero (optional)')
                        ->placeholder('/images/galle/proiecte/...-wide.webp')
                        ->helperText('Varianta -wide pe desktop; pe mobil se foloseste automat varianta patrata (acelasi nume fara -wide).'),
                ]),

            Block::make('sectiune_text')
                ->label('Sectiune text (H2 + continut)')
                ->icon('heroicon-o-document-text')
                ->schema([
                    HasTranslatableTabs::for(fn (string $loc, string $label) => [
                        TextInput::make("titlu.$loc")->label("Titlu H2 ($label)"),
                        Textarea::make("continut.$loc")
                            ->label("Continut ($label)")
                            ->helperText('Link-uri interne: [text](/url)')
                            ->rows(5),
                    ]),
                ]),

            Block::make('manifest')
                ->label('Manifest (statement mare)')
                ->icon('heroicon-o-sparkles')
                ->schema([
                    HasTranslatableTabs::for(fn (string $loc, string $label) => [
                        TextInput::make("eyebrow.$loc")->label("Eyebrow ($label)"),
                        TextInput::make("titlu_mare.$loc")->label("Titlu mare ($label)"),
                        TextInput::make("tagline.$loc")->label("Tagline ($label)"),
                        Textarea::make("intro.$loc")->label("Intro ($label)")->rows(3),
                    ]),
                ]),

            Block::make('servicii')
                ->label('Servicii (grid carduri)')
                ->icon('heroicon-o-wrench-screwdriver')
                ->schema([
                    HasTranslatableTabs::for(fn (string $loc, string $label) => [
                        TextInput::make("eyebrow.$loc")->label("Eyebrow ($label)"),
                        TextInput::make("titlu.$loc")->label("Titlu sectiune ($label)"),
                    ]),
                    Repeater::make('items')
                        ->label('Servicii')
                        ->schema([
                            Select::make('icon')
                                ->label('Icon')
                                ->options([
                                    'flacara' => 'Flacara (lemn de foc)',
                                    'copaci' => 'Copaci (exploatare forestiera)',
                                    'handshake' => 'Handshake (achizitie masa lemnoasa)',
                                    'excavator' => 'Excavator (curatare terenuri)',
                                    'frunza' => 'Frunza (lucrari silvice)',
                                    'camion' => 'Camion (transport)',
                                    'topor' => 'Topor (taiere)',
                                    'forwarder' => 'Forwarder (utilaj)',
                                ])
                                ->default('frunza')
                                ->required(),
                            HasTranslatableTabs::for(fn (string $loc, string $label) => [
                                TextInput::make("titlu.$loc")->label("Titlu ($label)"),
                                Textarea::make("text.$loc")->label("Text ($label)")->rows(2),
                            ]),
                            TextInput::make('imagine')
                                ->label('Imagine (optional)')
                                ->placeholder('/images/galle/proiecte/...webp'),
                            TextInput::make('url')->label('URL'),
                        ])
                        ->defaultItems(0)
                        ->columnSpanFull(),
                ]),

            Block::make('text_imagine')
                ->label('Text + Imagine')
                ->icon('heroicon-o-photo')
                ->schema([
                    HasTranslatableTabs::for(fn (string $loc, string $label) => [
                        TextInput::make("titlu.$loc")->label("Titlu ($label)"),
                        Textarea::make("continut.$loc")->label("Continut ($label)")->rows(5),
                        TextInput::make("cta_text.$loc")->label("Text buton ($label)"),
                    ]),
                    TextInput::make('imagine')->label('URL imagine'),
                    TextInput::make('cta_url')->label('URL buton'),
                    Select::make('pozitie')
                        ->options(['stanga' => 'Imagine stanga', 'dreapta' => 'Imagine dreapta'])
                        ->default('stanga'),
                ]),

            Block::make('splitter')
                ->label('Splitter (doua coloane CTA)')
                ->icon('heroicon-o-squares-2x2')
                ->schema([
                    Section::make('Bloc A')->columns(1)->schema([
                        HasTranslatableTabs::for(fn (string $loc, string $label) => [
                            TextInput::make("a_titlu.$loc")->label("Titlu A ($label)"),
                            Textarea::make("a_text.$loc")->label("Text A ($label)")->rows(3),
                            TextInput::make("a_cta_text.$loc")->label("CTA A text ($label)"),
                        ]),
                        TextInput::make('a_cta_url')->label('CTA A URL'),
                    ]),
                    Section::make('Bloc B')->columns(1)->schema([
                        HasTranslatableTabs::for(fn (string $loc, string $label) => [
                            TextInput::make("b_titlu.$loc")->label("Titlu B ($label)"),
                            Textarea::make("b_text.$loc")->label("Text B ($label)")->rows(3),
                            TextInput::make("b_cta_text.$loc")->label("CTA B text ($label)"),
                        ]),
                        TextInput::make('b_cta_url')->label('CTA B URL'),
                    ]),
                ]),

            Block::make('carduri')
                ->label('Carduri (De ce Galle)')
                ->icon('heroicon-o-rectangle-group')
                ->schema([
                    HasTranslatableTabs::for(fn (string $loc, string $label) => [
                        TextInput::make("eyebrow.$loc")->label("Eyebrow ($label)"),
                        TextInput::make("titlu.$loc")->label("Titlu sectiune ($label)"),
                    ]),
                    Repeater::make('items')
                        ->label('Carduri')
                        ->schema([
                            HasTranslatableTabs::for(fn (string $loc, string $label) => [
                                TextInput::make("titlu.$loc")->label("Titlu ($label)"),
                                Textarea::make("text.$loc")->label("Text ($label)")->rows(2),
                            ]),
                            TextInput::make('icon')->label('Icon (heroicon-o-...)')->placeholder('heroicon-o-truck'),
                        ])
                        ->defaultItems(0)
                        ->columnSpanFull(),
                ]),

            Block::make('certificari')
                ->label('Certificari (marquee logo-uri)')
                ->icon('heroicon-o-shield-check')
                ->schema([
                    HasTranslatableTabs::for(fn (string $loc, string $label) => [
                        TextInput::make("eyebrow.$loc")->label("Eyebrow ($label)"),
                        TextInput::make("titlu.$loc")->label("Titlu sectiune ($label)"),
                        TextInput::make("subtitlu.$loc")->label("Subtitlu ($label)"),
                    ]),
                ]),

            Block::make('solutie_verde')
                ->label('Solutia verde (dome line-art)')
                ->icon('heroicon-o-globe-europe-africa')
                ->schema([
                    HasTranslatableTabs::for(fn (string $loc, string $label) => [
                        TextInput::make("titlu.$loc")->label("Titlu ($label)"),
                        Textarea::make("text.$loc")->label("Text ($label)")->rows(3),
                        TextInput::make("eyebrow.$loc")->label("Eyebrow ($label)"),
                        TextInput::make("cta_text.$loc")->label("Text buton ($label)"),
                    ]),
                    TextInput::make('cta_url')->label('URL buton'),
                ]),

            Block::make('durabilitate_stat')
                ->label('Durabilitate (statistica split)')
                ->icon('heroicon-o-chart-bar-square')
                ->schema([
                    HasTranslatableTabs::for(fn (string $loc, string $label) => [
                        TextInput::make("titlu.$loc")->label("Titlu ($label)"),
                        Textarea::make("text.$loc")->label("Text ($label)")->rows(3),
                        TextInput::make("stat_top.$loc")->label("Stat — rand 1 ($label)"),
                        TextInput::make("stat_bottom.$loc")->label("Stat — rand 2 ($label)"),
                    ]),
                    TextInput::make('stat_number')->label('Stat — numar (ex: 100%)'),
                ]),

            Block::make('reciclare')
                ->label('Reciclare (simbol animat)')
                ->icon('heroicon-o-arrow-path-rounded-square')
                ->schema([
                    HasTranslatableTabs::for(fn (string $loc, string $label) => [
                        TextInput::make("titlu.$loc")->label("Titlu ($label)"),
                        Textarea::make("text.$loc")->label("Text ($label)")->rows(3),
                        TextInput::make("eyebrow.$loc")->label("Eyebrow ($label)"),
                        TextInput::make("cta_text.$loc")->label("Text buton ($label)"),
                    ]),
                    TextInput::make('cta_url')->label('URL buton'),
                ]),

            Block::make('cta')
                ->label('Call to Action')
                ->icon('heroicon-o-megaphone')
                ->schema([
                    HasTranslatableTabs::for(fn (string $loc, string $label) => [
                        TextInput::make("titlu.$loc")->label("Titlu ($label)"),
                        Textarea::make("text.$loc")->label("Text ($label)")->rows(2),
                        TextInput::make("buton_text.$loc")->label("Text buton ($label)"),
                    ]),
                    TextInput::make('buton_url')->label('URL buton'),
                ]),

            Block::make('galerie')
                ->label('Galerie imagini')
                ->icon('heroicon-o-photo')
                ->schema([
                    HasTranslatableTabs::for(fn (string $loc, string $label) => [
                        TextInput::make("titlu.$loc")->label("Titlu sectiune ($label)"),
                    ]),
                    Repeater::make('imagini')
                        ->label('Imagini')
                        ->simple(TextInput::make('url')->placeholder('https://... sau /storage/...'))
                        ->defaultItems(0)
                        ->columnSpanFull(),
                    TextInput::make('video')
                        ->label('Video (mp4, optional)')
                        ->placeholder('/images/galle/proiecte/...mp4'),
                    TextInput::make('video_poster')
                        ->label('Poster video (optional)')
                        ->placeholder('/images/galle/proiecte/...webp'),
                ]),

            Block::make('recenzii')
                ->label('Recenzii clienti')
                ->icon('heroicon-o-star')
                ->schema([
                    Select::make('serviciu')
                        ->label('Filtreaza dupa serviciu (gol = toate)')
                        ->options(Recenzie::SERVICII)
                        ->nullable(),
                    TextInput::make('limita')
                        ->label('Numar maxim de recenzii (gol = toate)')
                        ->numeric()
                        ->nullable(),
                    HasTranslatableTabs::for(fn (string $loc, string $label) => [
                        TextInput::make("eyebrow.$loc")->label("Eyebrow ($label)"),
                        TextInput::make("titlu.$loc")->label("Titlu sectiune ($label)"),
                    ]),
                ]),

            Block::make('faq')
                ->label('FAQ embed')
                ->icon('heroicon-o-question-mark-circle')
                ->schema([
                    Select::make('categorie')
                        ->label('Filtreaza FAQ dupa categorie (gol = toate)')
                        ->options(Faq::CATEGORII)
                        ->nullable(),
                    TextInput::make('limita')
                        ->label('Numar maxim de intrebari (gol = toate)')
                        ->numeric()
                        ->nullable(),
                    Toggle::make('link_toate')
                        ->label('Buton „Vezi toate intrebarile” spre /intrebari-frecvente')
                        ->default(false),
                    HasTranslatableTabs::for(fn (string $loc, string $label) => [
                        TextInput::make("titlu.$loc")->label("Titlu sectiune ($label)"),
                    ]),
                ]),
        ];
    }
}
