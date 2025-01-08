<?php

declare(strict_types=1);

namespace App\Filament\Resources\ShopResource\Filters;

use App\Models\Shop;
use Filament\Forms;
use Filament\Tables\Filters\BaseFilter;
use Illuminate\Database\Eloquent\Builder;

final class PaymentFilter extends BaseFilter
{
    protected function setUp(): void
    {
        $this->form([
            Forms\Components\Select::make('payment_status')
                ->native(false)
                ->options([
                    '1' => 'Has Payment',
                    '0' => 'No Payment',
                ]),

            Forms\Components\DatePicker::make('from_date')
                ->native(false)
                ->placeholder('Y-m-d')
                ->date(),

            Forms\Components\DatePicker::make('to_date')
                ->native(false)
                ->placeholder('Y-m-d')
                ->date(),
        ]);
    }

    /**
     * @param  Builder<Shop>  $builder
     * @param  array<string, mixed>  $data
     * @return Builder<Shop>
     */
    public function apply(Builder $builder, array $data = []): Builder
    {
        $fromDate = $data['from_date'] ?? null;
        $toDate = $data['to_date'] ?? null;

        $args = [
            'payments',
            fn (Builder $builder): Builder => $this->whereBetweenDate($builder, $fromDate, $toDate),
        ];

        return match ($data['payment_status']) {
            '1' => $builder->whereHas(...$args),
            '0' => $builder->whereDoesntHave(...$args),
            default => $builder
        };
    }

    /**
     * @param  Builder<Shop>  $builder
     * @return Builder<Shop>
     */
    protected function whereBetweenDate(Builder $builder, ?string $fromDate, ?string $toDate): Builder
    {
        if ($fromDate && $toDate) {
            return $builder->whereBetween('date', [$fromDate, $toDate]);
        }

        return $builder;
    }
}
