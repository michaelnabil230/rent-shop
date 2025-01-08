<?php

declare(strict_types=1);

use App\Enums\ShopStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shops', function (Blueprint $table): void {
            $table->id();
            $table->string('no');
            $table->string('code_ar');
            $table->string('code_en');
            $table->string('water_meter_no');
            $table->string('electricity_meter_no');
            $table->string('electricity_activation_no');
            $table->string('electricity_account_no');
            $table->date('rent_due_date');
            $table->enum('payment_type', ['cheque', 'cash', 'bank']);
            $table->date('contract_start_date');
            $table->date('contract_end_date');
            $table->decimal('rent_amount', 10, 2);
            $table->string('contract_no');
            $table->string('tenant_no');
            $table->string('tenant_name');
            $table->string('activity');
            $table->text('notes')->nullable();
            $table->string('status')->default(ShopStatus::PENDING->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
