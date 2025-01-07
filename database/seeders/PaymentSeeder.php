<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

final class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment::factory(5)->create();
    }
}
