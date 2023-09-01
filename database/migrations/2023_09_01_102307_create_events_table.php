<?php

declare(strict_types=1);

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
        Schema::create('events', static function (Blueprint $table) {
            $table->id();
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->unsignedBigInteger('appointment_time_id');
            $table->timestamps();

            $table->foreign('appointment_time_id')->references('id')->on('appointment_times');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
