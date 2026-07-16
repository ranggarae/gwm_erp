<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{
    protected $fillable = [
        'name', 'license_plate', 'year', 'engine_capacity', 'photo',
        'stnk_expiry_date', 'kir_expiry_date', 'insurance_expiry_date', 'status'
    ];
}
