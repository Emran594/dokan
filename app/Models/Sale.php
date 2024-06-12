<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_date', 'shift_id', 'tank_id'
    ];

    public function nozzles()
    {
        return $this->belongsToMany(Nozzle::class)->withPivot('opening_reading', 'closing_reading', 'sale_qty', 'total_sale');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function tank()
    {
        return $this->belongsTo(Tank::class);
    }
}

