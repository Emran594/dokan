<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nozzle extends Model
{
    use HasFactory;

    protected $fillable = [
        'nozzle_name',
        'nozzle_name_bangla',
        'tank_id',
        'current_meter_reading',
        'status',
    ];

    public function tank()
    {
        return $this->belongsTo(Tank::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}

