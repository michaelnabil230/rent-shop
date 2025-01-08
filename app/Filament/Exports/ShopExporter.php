<?php

declare(strict_types=1);

namespace App\Filament\Exports;

use App\Models\Shop;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

final class ShopExporter extends Exporter
{
    protected static ?string $model = Shop::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')->label('ID'),
            ExportColumn::make('no'),
            ExportColumn::make('code_ar'),
            ExportColumn::make('code_en'),
            ExportColumn::make('water_meter_no'),
            ExportColumn::make('electricity_meter_no'),
            ExportColumn::make('electricity_activation_no'),
            ExportColumn::make('electricity_account_no'),
            ExportColumn::make('rent_due_date'),
            ExportColumn::make('payment_type'),
            ExportColumn::make('contract_start_date'),
            ExportColumn::make('contract_end_date'),
            ExportColumn::make('rent_amount'),
            ExportColumn::make('contract_no'),
            ExportColumn::make('tenant_no'),
            ExportColumn::make('tenant_name'),
            ExportColumn::make('activity'),
            ExportColumn::make('status')
                ->state(fn (Shop $shop): string => $shop->status->getLabel()),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your shop export has completed and '.number_format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
