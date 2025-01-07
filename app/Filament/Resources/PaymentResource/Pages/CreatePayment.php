<?php

declare(strict_types=1);

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use Filament\Resources\Pages\CreateRecord;

final class CreatePayment extends CreateRecord
{
    protected static string $resource = PaymentResource::class;
}