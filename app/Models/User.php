<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'gender',
<<<<<<< HEAD
=======
        'password',
>>>>>>> e0e4cbf5f5f06cce6fee7d7e5c1d3240f4cbd241
        'role_id',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function role()
    {
<<<<<<< HEAD
        return $this->belongsTo(Role::class);
    }
=======
        return $this->belongsTo(Role::class, 'role_id');
    }    
>>>>>>> e0e4cbf5f5f06cce6fee7d7e5c1d3240f4cbd241

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
