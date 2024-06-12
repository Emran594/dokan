<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nozzle extends Model
{
    use HasFactory;

    protected $fillable = [
        'nozzle_name', 'tank_id', 'current_meter_reading'
    ];

    public function sales()
    {
        return $this->belongsToMany(Sale::class)->withPivot('opening_reading', 'closing_reading', 'sale_qty', 'total_sale');
    }

    public function tank()
    {
        return $this->belongsTo(Tank::class);
    }
}
