<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreastMilk extends Model
{
    use HasFactory;
    protected $table = 'breast_milk';
    protected $hidden = [
        'coordinate',
    ];
    protected $fillable = [
        'requester_id',
        'name',
        'gender',
        'phone',
        'location',
        'milk_quantity',
        'expires_at',
        'status',
        'coordinate',
        'otp_session_id',
        'is_verified',
        'milk_for',
        'country_code',
        'milk_type',
        'donor_id'
    ];
    protected $casts = [
        'is_verified' => 'boolean',
        'expires_at'  => 'datetime',
        'milk_for' => 'integer',
    ];
    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }
    public function donor()
    {
        return $this->belongsTo(User::class, 'donor_id');
    }

}
