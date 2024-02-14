<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menusItems = Menu::whereNull('id_padre')->with('children')->orderBy('id')->get();
        $menus = Menu::all();
        return view('menu.index', compact('menus', 'menusItems'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'nombre' => 'required|string',
            'url' => 'required|string',
            'id_padre' => 'nullable|integer',

        ]);

        $menu = Menu::create($request->all());

        return redirect()->route('menu.index');
    }

    public function show($id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return response()->json(['message' => 'Menu not found'], 404);
        }
        return response()->json($menu);
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return response()->json(['message' => 'Menu not found'], 404);
        }

        $menu->update($request->all());

        return redirect()->route('menu.index');
    }

    public function destroy($id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return response()->json(['message' => 'Menu not found'], 404);
        }
        $menu->delete();
        return response()->json(['message' => 'Menu deleted successfully']);
    }
}
