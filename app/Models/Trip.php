<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'fleet_id', 'driver_id', 'route_destination', 'purpose',
        'start_date', 'end_date', 'start_odometer', 'end_odometer', 'status'
    ];

    public function fleet() { return $this->belongsTo(Fleet::class); }
    public function driver() { return $this->belongsTo(Driver::class); }
}
