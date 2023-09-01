<?php

use App\Models\AppointmentTime;
use App\Models\Event;
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
        Schema::create('appointment_time_event', function (Blueprint $table) {
            $table->foreignIdFor(Event::class);
            $table->foreignIdFor(AppointmentTime::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_time_event');
    }
};
