<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupPoint extends Model
{
    use HasFactory;
    protected $fillable = [
        'pickup_points_name',
        'pickup_points_address',
        'pickup_points_phone',
        'pickup_points_phone2',
    ];
}
