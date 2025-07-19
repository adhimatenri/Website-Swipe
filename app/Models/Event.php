<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'title', 'description', 'datetime_start', 'datetime_end',
        'location', 'lat', 'long', 'poster_url', 'max_amount_participants',
        'is_active_event', 'created_by', 'updated_by'
    ];
}
