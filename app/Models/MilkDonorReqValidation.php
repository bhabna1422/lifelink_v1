<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilkDonorReqValidation extends Model
{
    use HasFactory;
     protected $table = 'milk_donor_req_validation';
    protected $fillable = [
        'donor_id',
        'breast_milk_id',
        'otp_session_id',
        'is_verified',
    ];
    protected $casts = [
        'is_verified' => 'boolean',
    ];

    public function donor()
    {
        return $this->belongsTo(User::class, 'donor_id');
    }

    public function breastMilk()
    {
        return $this->belongsTo(BreastMilk::class, 'breast_milk_id');
    }
}
