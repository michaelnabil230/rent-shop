<?php

declare(strict_types=1);

namespace App\Filament\Resources\ShopResource\Pages;

use App\Filament\Exports\ShopExporter;
use App\Filament\Resources\ShopResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

final class ListShops extends ListRecords
{
    protected static string $resource = ShopResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ExportAction::make()->exporter(ShopExporter::class),
        ];
    }
}
