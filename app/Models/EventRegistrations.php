<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EventRegistrations extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'event_registrations';

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
    const CREATED_AT = 'createdAt';

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
        'event_id',
        'jamaah_id',
        'created_by',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'createdAt' => 'datetime',
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
     * Get the event that this registration belongs to.
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    /**
     * Get the jamaah that registered.
     */
    public function jamaah()
    {
        return $this->belongsTo(Jamaah::class, 'jamaah_id');
    }

    /**
     * Find a registration record by registration ID, handling trim and UUID conversion.
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

        return static::find($registrationId);
    }
}