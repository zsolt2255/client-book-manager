<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\AppointmentTime;
use Illuminate\Database\Seeder;

class AppointmentTimeSeeder extends Seeder
{
    public function run(): void
    {
        $appointmentTimes = [
            [
                'title' => '2023-09-08 8-10',
                'start_date' => '2023-09-08',
                'end_date' => '2023-09-08',
                'day_of_week' => 0,
                'start_time' => '08:00:00',
                'end_time' => '10:00:00',
                'repetition' => 'none',
            ],
            [
                'title' => 'Hétfői találkozó',
                'start_date' => '2023-01-01',
                'end_date' => null,
                'day_of_week' => 1,
                'start_time' => '10:00:00',
                'end_time' => '12:00:00',
                'repetition' => 'even_weeks',
            ],
            [
                'title' => 'Szerdai találkozó',
                'start_date' => '2023-01-01',
                'end_date' => null,
                'day_of_week' => 3,
                'start_time' => '12:00:00',
                'end_time' => '16:00:00',
                'repetition' => 'odd_weeks',
            ],
            [
                'title' => 'Pénteki találkozó',
                'start_date' => '2023-01-01',
                'end_date' => null,
                'day_of_week' => 5,
                'start_time' => '10:00:00',
                'end_time' => '16:00:00',
                'repetition' => 'weekly',
            ],
            [
                'title' => 'Csütörtöki találkozó',
                'start_date' => '2023-06-01',
                'end_date' => '2023-11-30',
                'day_of_week' => 4,
                'start_time' => '16:00:00',
                'end_time' => '20:00:00',
                'repetition' => 'weekly',
            ],
        ];

        foreach ($appointmentTimes as $appointmentTime) {
            AppointmentTime::updateOrCreate([
                'start_date' => $appointmentTime['start_date'],
                'title' => $appointmentTime['title'],
            ], $appointmentTime);
        }
    }
}
