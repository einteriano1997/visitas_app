<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reporte;

class ReportController extends Controller
{
    public function index()
    {
        $reportes = Reporte::all();
        return response()->json($reportes);
    }

    public function store(Request $request)
    {
        $request->validate([
            
        ]);

        $reporte = Reporte::create($request->all());

        return response()->json($reporte, 201);
    }

    public function show($id)
    {
        $reporte = Reporte::find($id);
        if (!$reporte) {
            return response()->json(['message' => 'Reporte not found'], 404);
        }
        return response()->json($reporte);
    }

    public function update(Request $request, $id)
    {
        $reporte = Reporte::find($id);
        if (!$reporte) {
            return response()->json(['message' => 'Reporte not found'], 404);
        }

        $reporte->update($request->all());

        return response()->json($reporte);
    }

    public function destroy($id)
    {
        $reporte = Reporte::find($id);
        if (!$reporte) {
            return response()->json(['message' => 'Reporte not found'], 404);
        }
        $reporte->delete();
        return response()->json(['message' => 'Reporte deleted successfully']);
    }
}
