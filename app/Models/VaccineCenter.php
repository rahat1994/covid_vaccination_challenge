<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class VaccineCenter extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'vaccination_centers';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'city',
        'latitude',
        'longitude',
        'daily_limit',
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
