<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'day', 
        'start_time',
        'end_time',
        'room_name', 
        'instructor_id',
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}
