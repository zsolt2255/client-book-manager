<?php

declare(strict_types=1);

use App\Models\AppointmentTime;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('appointment_times', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('repetition', AppointmentTime::REPETITION_STATUSES);
            $table->unsignedInteger('day_of_week')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_times');
    }
};
