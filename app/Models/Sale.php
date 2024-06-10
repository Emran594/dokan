<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_date',
        'shift_id',
        'nozzle_id',
        'opening_reading',
        'closing_reading',
        'sale_qty',
        'sale_amount',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($sale) {
            $nozzle = $sale->nozzle;
            $nozzle->current_meter_reading += $sale->sale_qty;
            $nozzle->save();
        });
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function nozzle()
    {
        return $this->belongsTo(Nozzle::class);
    }
}
