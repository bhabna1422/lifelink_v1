<?php

// Admin.php (Model)
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    // Optionally, specify the table name if it's not the default 'admins'
    protected $table = 'admins';

    // The attributes that are mass assignable
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'phone', // Added phone field
        'otp_session_id', // Added OTP session ID field
    ];

    // The attributes that should be hidden for arrays
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // The attributes that should be cast to native types
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
