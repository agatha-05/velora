<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Produk', Product::count())
                ->description('Produk terdaftar di Velora')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]), 

            Stat::make('Kategori', Category::count())
                ->description('Pengelompokan fashion')
                ->descriptionIcon('heroicon-m-tag'),

            Stat::make('Stok Menipis', Product::where('stock', '<', 5)->count())
                ->description('Perlu segera restock')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
        ];
    }
}    