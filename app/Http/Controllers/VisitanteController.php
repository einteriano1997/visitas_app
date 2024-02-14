<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitante;
use App\Models\Menu;

class VisitanteController extends Controller
{
    public function index()
    {
        $visitantes = Visitante::all();
        $menusItems = Menu::whereNull('id_padre')->with('children')->orderBy('id')->get();        
        return view('visitors.index', compact('visitantes', 'menusItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dui' => 'required|string',
            'nombre' => 'required|string',
            'email' => 'required|email',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'required|string',

        ]);

        $visitante = Visitante::create($request->all());

        return response()->json($visitante, 201);
    }

    public function show($id)
    {
        $visitante = Visitante::find($id);
        if (!$visitante) {
            return response()->json(['message' => 'Visitante not found'], 404);
        }
        return response()->json($visitante);
    }

    public function update(Request $request, $id)
    {
        $visitante = Visitante::find($id);
        if (!$visitante) {
            return response()->json(['message' => 'Visitante not found'], 404);
        }

        $visitante->update($request->all());

        return response()->json($visitante);
    }

    public function destroy($id)
    {
        $visitante = Visitante::find($id);
        if (!$visitante) {
            return response()->json(['message' => 'Visitante not found'], 404);
        }
        $visitante->delete();
        return response()->json(['message' => 'Visitante deleted successfully']);
    }
}
