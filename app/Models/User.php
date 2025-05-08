<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'type'];

    public function isStudent()
    {
        return $this->type === 'student';
    }

    public function isInstructor()
    {
        return $this->type === 'instructor';
    }
}
