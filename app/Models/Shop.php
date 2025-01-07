<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ShopStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Shop extends Model
{
    /** @use HasFactory<\Database\Factories\ShopFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'no',
        'code_ar',
        'code_en',
        'water_meter_no',
        'electricity_meter_no',
        'electricity_activation_no',
        'electricity_account_no',
        'rent_due_date',
        'payment_type',
        'contract_start_date',
        'contract_end_date',
        'rent_amount',
        'contract_no',
        'tenant_no',
        'tenant_name',
        'activity',
        'notes',
        'status',
    ];

    /**
     * Get all of the payments for the Shop
     *
     * @return HasMany<Payment, covariant $this>
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => ShopStatus::class,
        ];
    }
}
