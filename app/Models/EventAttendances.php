<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\EventRegistrations;  // <— import

class EventAttendances extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'event_attendances';

    /**
     * The primary key type.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'check_in_at';

    /**
     * There is no "updated at" column for this model.
     *
     * @var string|null
     */
    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'registration_id',
        'event_id',
        'jamaah_id',
        'scanned_by_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'check_in_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Boot function from Laravel.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    /**
     * Get the registration associated with this attendance.
     */
    public function registration()
    {
        return $this->belongsTo(EventRegistrations::class, 'registration_id');
    }

    /**
     * Get the event that was attended.
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    /**
     * Get the jamaah who attended.
     */
    public function jamaah()
    {
        return $this->belongsTo(Jamaah::class, 'jamaah_id');
    }

    /**
     * Get the user who scanned the attendance.
     */
    public function scanner()
    {
        return $this->belongsTo(User::class, 'scanned_by_id');
    }

    /**
     * Record an attendance based on a registration.
     */
    public static function markJamaahAttendance(EventRegistrations $registration): self
    {
        return static::create([
            'registration_id' => $registration->id,
            'event_id'        => $registration->event_id,
            'jamaah_id'       => $registration->jamaah_id,
            'check_in_at'     => now(),
        ]);
    }

    /**
     * Find an attendance record by registration ID.
     */
    public static function findByRegistrationId(string $registrationId): ?self
    {
        $registrationId = trim($registrationId);
        if (! Str::isUuid($registrationId)) {
            try {
                $registrationId = (string) Str::uuid($registrationId);
            } catch (\Exception $e) {
                return null;
            }
        }
        return static::where('registration_id', $registrationId)->first();
    }
}
