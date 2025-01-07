<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Enums\ShopStatus;
use App\Models\Shop;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

final class AdminWidgets extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Stat::make('Total Shops', Shop::count()),

            Stat::make('Total Active Shops', Shop::where('status', ShopStatus::ACTIVE)->count()),

            Stat::make('Total Not Active Shops', Shop::where('status', ShopStatus::NOT_ACTIVE)->count()),

            Stat::make('Total Pending Shops', Shop::where('status', ShopStatus::PENDING)->count()),
        ];
    }
}
