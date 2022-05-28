<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VentasController extends Controller
{
   
    public function index()
    {
        $productos = Producto::where('activo', true)->get();
        return Inertia::render('Ventas/Index', ['productos' => $productos]);
    }

    public function show($id)
    {
        //
    }

}
