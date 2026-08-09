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
        if (!Schema::hasTable('staff_shifts')) {
            Schema::create('staff_shifts', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('staff_name');
                $table->string('role')->default('receptionist'); // receptionist, trainer, security, cleaner
                $table->string('shift_name'); // Shift Pagi (06:00 - 14:00), Shift Siang (14:00 - 22:00)
                $table->date('shift_date');
                $table->time('start_time')->default('06:00:00');
                $table->time('end_time')->default('14:00:00');
                $table->string('status')->default('scheduled'); // scheduled, completed, absent
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('staff_attendances')) {
            Schema::create('staff_attendances', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('staff_shift_id')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('staff_name');
                $table->timestamp('clock_in')->nullable();
                $table->timestamp('clock_out')->nullable();
                $table->string('clock_in_status')->default('ontime'); // ontime, late, out_of_radius
                $table->string('clock_out_status')->default('ontime'); // ontime, early_leave
                $table->decimal('latitude', 10, 7)->nullable();
                $table->decimal('longitude', 10, 7)->nullable();
                $table->integer('distance_meters')->default(0);
                $table->string('selfie_path')->nullable();
                $table->boolean('face_verified')->default(true);
                $table->string('device_info')->nullable();
                $table->decimal('total_hours_worked', 5, 2)->default(0);
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_attendances');
        Schema::dropIfExists('staff_shifts');
    }
};
