<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tank extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_bangla',
        'tank_size',
        'opening_stock',
        'purchase_price',
        'sell_price',
        'status',
    ];

    public function nozzles()
    {
        return $this->hasMany(Nozzle::class);
    }
}
