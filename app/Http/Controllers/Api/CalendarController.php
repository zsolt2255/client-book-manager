<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventResourceCollection;
use App\Http\Services\EventService;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CalendarController extends Controller
{
    /**
     * @param EventService $eventService
     */
    public function __construct(private readonly EventService $eventService)
    {

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $events = $this->eventService->fetchEvents($request);

        return (new EventResourceCollection($events))->response();
    }

    /**
     * @param StoreEventRequest $request
     * @return JsonResponse
     */
    public function store(StoreEventRequest $request): JsonResponse
    {
        $event = $this->eventService->store($request);

        if (! $event instanceof Event) {
            return $event;
        }

        return (new EventResource($event))->response();
    }

    /**
     * @param string $eventId
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(string $eventId, Request $request): JsonResponse
    {
        $this->eventService->destroy($eventId);

        return response()->json([
            'success' => true,
            'message' => 'The event has been successfully deleted',
        ], Response::HTTP_OK);
    }
}
