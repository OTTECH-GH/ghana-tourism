<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_reference')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->morphs('payable');
            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('GHS');
            $table->enum('payment_method', ['mobile_money', 'card', 'wallet', 'bank'])->default('mobile_money');
            $table->string('provider')->nullable();
            $table->string('provider_reference')->nullable();
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $table->json('metadata')->nullable();
            $table->timestamps();
        });

        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 10, 2);
            $table->decimal('percentage', 5, 2);
            $table->string('currency')->default('GHS');
            $table->enum('type', ['hotel', 'transport', 'guide'])->default('hotel');
            $table->timestamps();
        });

        Schema::create('payouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('GHS');
            $table->enum('payment_method', ['mobile_money', 'bank'])->default('mobile_money');
            $table->string('account_details')->nullable();
            $table->enum('status', ['pending', 'processing', 'completed', 'failed'])->default('pending');
            $table->string('reference')->nullable();
            $table->timestamps();
        });

        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('GHS');
            $table->text('reason')->nullable();
            $table->enum('status', ['pending', 'approved', 'processed', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('refunds');
        Schema::dropIfExists('payouts');
        Schema::dropIfExists('commissions');
        Schema::dropIfExists('payments');
    }
};
