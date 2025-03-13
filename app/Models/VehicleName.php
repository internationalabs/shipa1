<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleName extends Model
{
    use HasFactory;

    protected $table = 'wp_vehiclelisting';

    protected $fillable = [
        'UserId',
        'make',
        'model',
        'size',
        'status',
    ];
}
