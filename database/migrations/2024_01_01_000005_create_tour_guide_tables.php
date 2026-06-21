<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tour_guides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('experience')->nullable();
            $table->integer('experience_years')->default(0);
            $table->json('languages')->nullable();
            $table->json('specializations')->nullable();
            $table->decimal('price_per_hour', 10, 2)->default(0);
            $table->decimal('price_per_day', 10, 2)->default(0);
            $table->string('currency')->default('GHS');
            $table->string('photo')->nullable();
            $table->string('id_document')->nullable();
            $table->boolean('is_available')->default(true);
            $table->enum('status', ['pending', 'approved', 'rejected', 'suspended'])->default('pending');
            $table->decimal('avg_rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->integer('total_bookings')->default(0);
            $table->foreignId('region_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('guide_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_reference')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tour_guide_id')->constrained()->cascadeOnDelete();
            $table->foreignId('transport_booking_id')->nullable()->constrained()->nullOnDelete();
            $table->date('booking_date');
            $table->time('start_time')->nullable();
            $table->integer('duration_hours')->default(1);
            $table->decimal('total_amount', 10, 2);
            $table->string('currency')->default('GHS');
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guide_bookings');
        Schema::dropIfExists('tour_guides');
    }
};
