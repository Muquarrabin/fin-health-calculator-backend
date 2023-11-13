<?php

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
        Schema::create('finance_data', function (Blueprint $table) {
            $table->id();
            $table->decimal('monthly_income');
            $table->decimal('monthly_expense');
            $table->decimal('monthly_debt_payment');
            $table->decimal('total_debts');
            $table->decimal('total_assets');
            $table->double('debt_to_income_ratio');
            $table->double('savings_ratio');
            $table->decimal('net_worth');
            $table->double('health_score');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_data');
    }
};
