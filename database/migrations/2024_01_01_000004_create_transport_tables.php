<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transport_companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('business_document')->nullable();
            $table->string('logo')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'suspended'])->default('pending');
            $table->timestamps();
        });

        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('transport_company_id')->nullable()->constrained()->nullOnDelete();
            $table->string('make');
            $table->string('model');
            $table->integer('year')->nullable();
            $table->string('color')->nullable();
            $table->string('plate_number')->unique();
            $table->enum('vehicle_type', ['small_car', 'suv', 'van', 'mini_bus', 'tour_bus', 'executive_bus'])->default('small_car');
            $table->integer('capacity')->default(4);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('insurance_document')->nullable();
            $table->string('roadworthy_document')->nullable();
            $table->boolean('air_conditioned')->default(false);
            $table->decimal('price_per_km', 10, 2)->default(0);
            $table->decimal('base_price', 10, 2)->default(0);
            $table->boolean('is_available')->default(true);
            $table->enum('status', ['pending', 'approved', 'rejected', 'suspended'])->default('pending');
            $table->timestamps();
        });

        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('transport_company_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('vehicle_id')->nullable()->constrained()->nullOnDelete();
            $table->string('licence_number')->unique();
            $table->string('licence_document')->nullable();
            $table->integer('experience_years')->default(0);
            $table->json('languages')->nullable();
            $table->boolean('is_available')->default(true);
            $table->enum('status', ['pending', 'approved', 'rejected', 'suspended'])->default('pending');
            $table->decimal('avg_rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->integer('total_trips')->default(0);
            $table->timestamps();
        });

        Schema::create('transport_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_reference')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('driver_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('vehicle_id')->nullable()->constrained()->nullOnDelete();
            $table->string('pickup_location');
            $table->decimal('pickup_latitude', 10, 7)->nullable();
            $table->decimal('pickup_longitude', 10, 7)->nullable();
            $table->date('trip_date');
            $table->time('trip_time');
            $table->integer('passengers')->default(1);
            $table->enum('vehicle_type', ['small_car', 'suv', 'van', 'mini_bus', 'tour_bus', 'executive_bus'])->default('small_car');
            $table->boolean('return_trip')->default(false);
            $table->boolean('full_day')->default(false);
            $table->decimal('estimated_distance_km', 10, 2)->default(0);
            $table->decimal('estimated_duration_hours', 8, 2)->default(0);
            $table->decimal('estimated_amount', 10, 2)->default(0);
            $table->decimal('final_amount', 10, 2)->nullable();
            $table->string('currency')->default('GHS');
            $table->enum('status', ['pending', 'accepted', 'driver_assigned', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->timestamp('trip_started_at')->nullable();
            $table->timestamp('trip_ended_at')->nullable();
            $table->decimal('platform_commission', 10, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('trip_destinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transport_booking_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tourism_site_id')->nullable()->constrained()->nullOnDelete();
            $table->string('destination_name');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->integer('stop_order')->default(1);
            $table->integer('estimated_wait_minutes')->default(60);
            $table->timestamps();
        });

        Schema::create('trip_tracking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transport_booking_id')->constrained()->cascadeOnDelete();
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->decimal('speed_kmh', 8, 2)->nullable();
            $table->timestamp('recorded_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trip_tracking');
        Schema::dropIfExists('trip_destinations');
        Schema::dropIfExists('transport_bookings');
        Schema::dropIfExists('drivers');
        Schema::dropIfExists('vehicles');
        Schema::dropIfExists('transport_companies');
    }
};
