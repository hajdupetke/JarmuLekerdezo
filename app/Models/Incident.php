<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

    protected $fillable = [
        'location',
        'time',
        'desc'
    ];

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'vehicle_incident', 'incident_id', 'vehicle_id');
    }
}
