<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle;

class SearchHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'searched_license',
        'search_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vehicle()
    {
        $vehicle = Vehicle::where('license', $this->searched_license)->get();
        return $vehicle;
    }
}
