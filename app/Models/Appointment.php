<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vaccination_center_id',
        'appointment_at',
    ];

    protected $casts = [
        'appointment_at' => 'datetime',
    ];

    protected $table = 'vaccination_appointments';

    protected $with = ['user', 'vaccinationCenter'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vaccinationCenter()
    {
        return $this->belongsTo(VaccineCenter::class);
    }
}
