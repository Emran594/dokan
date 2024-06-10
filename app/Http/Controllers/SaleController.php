<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Shift;
use App\Models\Tank;
use App\Models\Nozzle;

class SaleController extends Controller
{
    function SalePage():View{
        return view('pages.dashboard.sale-page');
    }
    function create():View{
        $shifts = Shift::all();
        $tanks = Tank::all();
        return view('pages.dashboard.sale-create', compact('shifts', 'tanks'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'sale_date' => 'required|date',
            'shift_id' => 'required|exists:shifts,id',
            'tank_id' => 'required|exists:tanks,id',
            'opening_reading.*' => 'required|numeric',
            'closing_reading.*' => 'required|numeric',
            'sale_qty.*' => 'required|numeric',
        ]);
    
        foreach ($data['opening_reading'] as $nozzleId => $openingReading) {
            Sale::create([
                'sale_date' => $data['sale_date'],
                'shift_id' => $data['shift_id'],
                'nozzle_id' => $nozzleId,
                'opening_reading' => $openingReading,
                'closing_reading' => $data['closing_reading'][$nozzleId],
                'sale_qty' => $data['sale_qty'][$nozzleId],
                'sale_amount' => $data['sale_qty'][$nozzleId] * Nozzle::find($nozzleId)->tank->sell_price,
                'status' => 'completed',
            ]);
    
            $nozzle = Nozzle::find($nozzleId);
            $nozzle->current_meter_reading = $data['closing_reading'][$nozzleId];
            $nozzle->save();
        }
    
        return response()->json(['message' => 'Sales recorded successfully'], 201);
    }

    public function getNozzlesByTank($tankId)
    {
        $nozzles = Nozzle::where('tank_id', $tankId)->get(['id', 'nozzle_name', 'current_meter_reading']);
        return response()->json(['nozzles' => $nozzles]);
    }
}