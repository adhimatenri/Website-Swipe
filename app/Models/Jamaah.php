<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
