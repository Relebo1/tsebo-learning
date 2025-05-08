<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Instructor extends Authenticatable
{
    use HasFactory, Notifiable;

    // Mass assignable attributes
    protected $fillable = [
        'fullname',
        'email',
        'password',
        'subject',
        'certifications',
        'certificate_uploads',
        'certificate_uploads_path',
        'fee',
        'location',
        'bio',
        'image',
        'path',
        'status',
    ];

    // Casts for specific attributes
    protected $casts = [
        'fee' => 'decimal:2',  // Ensuring that fee is stored as a decimal with 2 decimal places
    ];


}
