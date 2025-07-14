<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
    use HasFactory;

    protected $table = 'ambulances';
    protected $casts = [
        'is_verified' => 'boolean',
    ];
    protected $fillable = [
        'name',
        'phone',
        'group',
        'address',
        'landmark',
        'creator',
        'reg_number',
        'otp_session_id',
        'otp',
        'is_verified',
        'deleted_at',
        'country_code'
    ];
    protected $hidden = [
        'coordinate',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'creator', 'id');
    }
    
}
