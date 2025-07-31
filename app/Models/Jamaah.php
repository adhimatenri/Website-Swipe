<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Illuminate\Support\Str;
use App\Models\EventRegistrations;  


class Jamaah extends Model
{
    use SoftDeletes;
    protected $table = 'jamaah';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'name', 'dob', 'phone', 'email',
        'address', 'gender', 'job', 'created_at', 'created_by',
        'updated_at', 'updated_by', 'deleted_at'
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
     * Find the Jamaah associated with a registration ID.
     */
    public static function findByJamaahId(string $jamaahId): ?self
    {
        return static::find($jamaahId);
    }

    /**
     * Find a jamaah by email or phone.
     */
    public static function findByEmailOrPhone(string $email, string $phone): ?self
    {
        return static::where('email', $email)
            ->orWhere('phone', $phone)
            ->first();
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistrations::class, 'jamaah_id', 'id');
    }

    /**
     * Find a jamaah by email or phone, or create one with provided attributes.
     */
    public static function createNewJamaah(array $attributes): self
    {
        $jamaah = static::create([
            'name'    => $attributes['name'],
            'dob'     => $attributes['dob'],
            'gender'  => $attributes['gender'],
            'phone'   => $attributes['phone'],
            'email'   => $attributes['email'],
            'address' => $attributes['address'],
        ]);

        return $jamaah;
    }
}