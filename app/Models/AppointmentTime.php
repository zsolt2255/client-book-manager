<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AppointmentTime extends Model
{
    public const REPETITION_NONE = 'none';
    public const REPETITION_WEEKLY = 'weekly';
    public const REPETITION_EVEN_WEEKS = 'even_weeks';
    public const REPETITION_ODD_WEEKS = 'odd_weeks';

    public const REPETITION_STATUSES = [
        self::REPETITION_NONE,
        self::REPETITION_WEEKLY,
        self::REPETITION_EVEN_WEEKS,
        self::REPETITION_ODD_WEEKS,
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'repetition',
        'day_of_week',
        'start_time',
        'end_time'
    ];

    /**
     * @return HasMany
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
