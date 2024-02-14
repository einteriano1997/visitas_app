<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuDisplayController extends Controller
{
    public function index()
    {
        $menus = Menu::whereNull('id_padre')->with('children')->orderBy('id')->get();

        return view('welcome', compact('menus'));
    }
}
