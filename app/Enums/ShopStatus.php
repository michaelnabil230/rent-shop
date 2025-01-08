<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Concerns\MagicalEnum;
use Filament\Support\Contracts\HasLabel;

enum ShopStatus: string implements HasLabel
{
    use MagicalEnum;

    case PENDING = 'pending';

    case ACTIVE = 'active';

    case NOT_ACTIVE = 'not_active';

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::ACTIVE => 'Active',
            self::NOT_ACTIVE => 'Not active',
        };
    }
}
