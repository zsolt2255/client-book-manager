<?php

namespace Database\Seeders;

use App\Http\Services\EventService;
use App\Models\AppointmentTime;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * @return void
     * @throws BindingResolutionException
     */
    public function run(): void
    {
        $appointmentTimes = AppointmentTime::all();

        $eventService = app()->make(EventService::class);

        foreach ($appointmentTimes as $appointmentTime) {
            $eventService->generateAndStoreFromApptTime($appointmentTime);
        }
    }
}
