<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'name', 'license_number', 'license_type', 'license_expiry_date', 'phone', 'status'
    ];
}
