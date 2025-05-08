<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'dob',
        'profile_picture', // Ensure this stores a filename if used for images
        'password',
        'status',
    ];

    protected $casts = [
        'dob' => 'date',
        'status' => 'string', // Change to 'boolean' or 'integer' if necessary
    ];
}
