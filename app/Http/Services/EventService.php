<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Http\Requests\StoreEventRequest;
use App\Models\AppointmentTime;
use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class EventService
{
    /**
     * @param Request $request
     * @return Collection|\Illuminate\Support\Collection|array
     */
    public function fetchEvents(Request $request): Collection|\Illuminate\Support\Collection|array
    {
        $start = $request->get('start', now());
        $end = $request->get('end', now()->addMonths());

        return Event::query()
            ->with(['appointmentTime:id,title'])
            ->whereDate('start_time', '>=', $start)
            ->orWhereDate('end_time', '<=', $end)
            ->get(['id', 'start_time as start', 'end_time as end', 'appointment_time_id'])
            ->map(function (Event $event) {
                $event->title = $event->appointmentTime ? $event->appointmentTime->title : null;
                return $event;
            });
    }

    /**
     * @param StoreEventRequest $request
     * @return JsonResponse|void
     */
    public function store(StoreEventRequest $request)
    {
        $event = Event::whereBetween('start_time', [$request->start, $request->end])->first();

        if ($event) {
            return response()->json([
                'success' => false,
                'message' => 'The appointment is booked',
            ], Response::HTTP_BAD_REQUEST);
        }

        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);

        $appointmentTime = AppointmentTime::create([
            'title' => $request->title,
            'start_date' =>$start->format('Y-m-d'),
            'end_date' => $end->format('Y-m-d'),
            'repetition' => 'none',
            'day_of_week' => null,
            'start_time' => $start->format('H:i:s'),
            'end_time' => $end->format('H:i:s')
        ]);

        return Event::create([
            'start_time' => $request->start,
            'end_time' => $request->end,
            'appointment_time_id' => $appointmentTime->id,
        ]);
    }

    /**
     * @param string $eventId
     * @return void
     */
    public function destroy(string $eventId): void
    {
        $event = Event::where('id', $eventId)->first();

        if ($event) {
            $event->delete();
        }
    }

    /**
     * @param AppointmentTime $appointmentTime
     * @return void
     */
    public function generateAndStoreFromAppTime(AppointmentTime $appointmentTime): void
    {
        $events = collect();

        $startDate = Carbon::parse($appointmentTime->start_date);
        $endDate = $appointmentTime->end_date ? Carbon::parse($appointmentTime->end_date) : $startDate->copy()->addYear();

        while ($startDate->lte($endDate)) {
            if ($this->isRepetitionValid($startDate, $appointmentTime)) {
                $events->push([
                    'start_time' => $this->calculateFullTime($startDate->copy(), $appointmentTime->start_time),
                    'end_time' => $this->calculateFullTime($startDate, $appointmentTime->end_time),
                    'appointment_time_id' => $appointmentTime->id,
                ]);
            }

            $startDate->addDay();
        }

        Event::insert($events->toArray());
    }

    /**
     * @param Carbon $date
     * @param AppointmentTime $appointmentTime
     * @return bool
     */
    protected function isRepetitionValid(Carbon $date, AppointmentTime $appointmentTime): bool
    {
        if ($appointmentTime->repetition === AppointmentTime::REPETITION_NONE) {
            return true;
        }

        if ($appointmentTime->repetition === AppointmentTime::REPETITION_WEEKLY) {
            return $date->dayOfWeek === $appointmentTime->day_of_week;
        }

        if ($appointmentTime->repetition === AppointmentTime::REPETITION_EVEN_WEEKS) {
            return $date->dayOfWeek === $appointmentTime->day_of_week && $date->weekOfYear % 2 === 0;
        }

        if ($appointmentTime->repetition === AppointmentTime::REPETITION_ODD_WEEKS) {
            return $date->dayOfWeek === $appointmentTime->day_of_week && $date->weekOfYear % 2 === 1;
        }

        return false;
    }

    /**
     * @param Carbon $date
     * @param string $time
     * @return Carbon
     */
    protected function calculateFullTime(Carbon $date, string $time): Carbon
    {
        return $date->copy()->setTimeFromTimeString($time);
    }
}
