<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'start_time',
        'end_time',
        'appointment_time_id'
    ];

    /**
     * @return BelongsTo
     */
    public function appointmentTime(): BelongsTo
    {
        return $this->belongsTo(AppointmentTime::class);
    }
}
