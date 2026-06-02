<?php

namespace App\Filament\Widgets;

use App\Enums\ComandaStatus;
use App\Models\ComandaLemn;
use App\Models\Lead;
use App\Models\Specie;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class GalleStatsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Comenzi lemn noi', ComandaLemn::where('status', ComandaStatus::Nou->value)->count())
                ->description('In ultimele 7 zile: ' . ComandaLemn::where('created_at', '>=', now()->subDays(7))->count())
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('danger'),

            Stat::make('Lead-uri noi', Lead::where('status', ComandaStatus::Nou->value)->count())
                ->description('In ultimele 7 zile: ' . Lead::where('created_at', '>=', now()->subDays(7))->count())
                ->descriptionIcon('heroicon-m-envelope-open')
                ->color('warning'),

            Stat::make('Specii active', Specie::where('is_active', true)->count())
                ->description('Total catalog: ' . Specie::count())
                ->descriptionIcon('heroicon-m-rectangle-stack')
                ->color('success'),

            Stat::make('Comenzi finalizate (total)', ComandaLemn::where('status', ComandaStatus::Finalizat->value)->count())
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),
        ];
    }
}
