<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoStoreRequest;
use App\Models\Producto;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::all();
        return Inertia::render('Productos/Index', ['productos' => $productos]);
    }

    public function create()
    {
        return Inertia::render('Productos/Create');
    }

    public function store(ProductoStoreRequest $request)
    {
        $producto              = new Producto;
        $producto->nombre      = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio      = $request->precio;
        $producto->activo      = $request->activo;
        $producto->stock       = $request->stock;

        if ($request->file('file')) {
            $url              = Storage::put('imagenes', $request->file('file'));
            $producto->imagen = $url;
        }

        $producto->save();

        return Redirect::route('productos.index');
    }

    public function edit(Producto $producto)
    {
        return Inertia::render('Productos/Edit', ['producto' => $producto]);
    }

    public function update(ProductoStoreRequest $request, Producto $producto)
    {
        $producto->update($request->all());
        return Redirect::route('productos.index');
    }

}
