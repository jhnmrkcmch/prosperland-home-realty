<?php
namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index() {
        $Warehouses = Warehouse::all();
        return view('warehouse', compact('Warehouses'));
    }

    public function show($id) {
        $Warehouse = Warehouse::findOrFail($id);
        return view('warehouse_show', compact('Warehouse'));
    }

    public function updateInline(Request $request) {
        $warehouse = Warehouse::findOrFail($request->id);
        $column = $request->column;

        $cleanValue = str_replace(',', '', $request->value);
        
        $warehouse->$column = $request->value;
        $warehouse->save();

        return response()->json(['success' => true]);
    }
}