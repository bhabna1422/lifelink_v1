<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'initiater_id',
        'blood_req_id',
        'ambulance_req_id',
        'title',
        'message',
        'type',
    ];

    public function initiator()
    {
        return $this->belongsTo(User::class, 'initiater_id');
    }
    public function bloodRequest()
    {
        return $this->belongsTo(BloodRequest::class, 'blood_req_id');
    }
    public function ambulanceRequest()
    {
        return $this->belongsTo(Ambulance::class, 'ambulance_req_id');
    }
}
