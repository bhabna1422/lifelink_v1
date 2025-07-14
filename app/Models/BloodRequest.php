<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'requester_id', 'name', 'blood_group', 'expires_at', 'dob', 'gender',
        'phone', 'address', 'location', 'otp_session_id', 'otp',
        'is_verified', 'status', 'country_code','blood_for','message_to_donor','donor_id'
    ];

    protected $casts = [
        'coordinate' => 'array',
        'is_verified' => 'boolean',
        'expires_at' => 'datetime',
        'dob' => 'date',
    ];
    protected $table = 'blood';
    protected $hidden = [
       
        'coordinate',
    ];
// Relationship to the user who made the blood request
public function requester()
{
    return $this->belongsTo(User::class, 'requester_id', 'id');
}

// Relationship to the donor assigned to this request (optional)
public function donor()
{
    return $this->belongsTo(User::class, 'donor_id', 'id');
}

}
