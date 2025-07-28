<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'slug',
        'title',
        'description',
        'datetime_start',
        'datetime_end',
        'location',
        'poster_url',
        'max_amount_participants',
        'is_active_event',
        'created_by_id',
        'updated_by_id',
        'deactivated_by_id',
        'deleted_by_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'datetime_start'     => 'datetime',
        'datetime_end'       => 'datetime',
        'is_active_event'    => 'boolean',
    ];

    /**
     * Find the event associated with a eventID
     */
    public static function findByEventId(string $eventId): ?self
    {
        return static::find($eventId);
    }
}
