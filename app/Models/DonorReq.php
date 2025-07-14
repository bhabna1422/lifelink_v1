<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorReq extends Model
{
    use HasFactory;
    protected $table = 'donor_req_validation';
    protected $fillable = [
        'donor_id',
        'blood_id',
        'otp_session_id',
        'is_verified'
    ];
    public function user()
{
    return $this->belongsTo(\App\Models\User::class, 'donor_id');
}

public function blood()
{
    return $this->belongsTo(\App\Models\BloodRequest::class, 'blood_id');
}

}
