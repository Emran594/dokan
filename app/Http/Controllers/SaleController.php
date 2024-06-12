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
    public function SalePage(): View
    {
        $sales = Sale::with(['shift', 'nozzles'])->get();

        return view('pages.dashboard.sale-page', compact('sales'));
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
    public function editSale($id) {
        $sale = Sale::with(['shift', 'nozzles'])->findOrFail($id);
        $shifts = Shift::all();
        $tanks = Tank::all();
        return view('pages.dashboard.sale-update', compact('sale', 'shifts', 'tanks'));
    }
    public function update(Request $request, $id)
{
    $data = $request->validate([
        'sale_date' => 'required|date',
        'shift_id' => 'required|exists:shifts,id',
        'tank_id' => 'required|exists:tanks,id',
        'opening_reading.*' => 'required|numeric',
        'closing_reading.*' => 'required|numeric',
        'sale_qty.*' => 'required|numeric',
    ]);

    $sale = Sale::findOrFail($id);

    // Update sale fields
    $sale->update([
        'sale_date' => $data['sale_date'],
        'shift_id' => $data['shift_id'],
        'tank_id' => $data['tank_id']
    ]);

    foreach ($data['opening_reading'] as $nozzleId => $openingReading) {
        $sale->nozzles()->updateExistingPivot($nozzleId, [
            'opening_reading' => $openingReading,
            'closing_reading' => $data['closing_reading'][$nozzleId],
            'sale_qty' => $data['sale_qty'][$nozzleId],
            'total_sale' => $data['closing_reading'][$nozzleId] - $openingReading,
        ]);

        $nozzle = Nozzle::find($nozzleId);
        $nozzle->current_meter_reading = $data['closing_reading'][$nozzleId];
        $nozzle->save();
    }

    return response()->json(['message' => 'Sale updated successfully'], 200);
}

}
