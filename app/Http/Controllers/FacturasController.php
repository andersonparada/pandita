<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacturaStoreRequest;
use App\Models\Estado;
use App\Models\Factura;
use App\Models\FacturaDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class FacturasController extends Controller
{
    //mostrar pedidos sin finalizar
    public function index()
    {
        if (auth()->user()->admin == 1) {
            $facturas = Factura::query()
                ->where('estado_id', '!=', 3)
                ->with('detalles.producto')
                ->with('usuario')
                ->with('estado')
                ->get();
        } else {
            $facturas = Factura::query()
                ->where('user_id', auth()->user()->id)
                ->with('detalles.producto')
                ->with('usuario')
                ->with('estado')
                ->get();
        }

        return Inertia::render('Facturas/Index', ['facturas' => $facturas]);
    }

    public function store(FacturaStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            $direccion = $request->direccion;
            $nit       = $request->nit;
            $articulos = $request->articulos;

            //creacion de la factura
            $factura            = new Factura;
            $factura->user_id   = auth()->user()->id;
            $factura->estado_id = 1;
            $factura->direccion = $direccion;
            $factura->nit       = $nit;
            $factura->save();

            foreach ($articulos as $articulo) {
                $producto = $articulo['producto'];
                $cantidad = $articulo['cantidad'];

                if ($cantidad <= 0) {
                    abort(500, "La cantidad del producto " . $articulo['nombre'] . " debe ser mayor a 0");
                }

                $facturaDetalle              = new FacturaDetalle;
                $facturaDetalle->factura_id  = $factura->id;
                $facturaDetalle->producto_id = $producto['id'];
                $facturaDetalle->precio      = $producto['precio'];
                $facturaDetalle->cantidad    = $cantidad;
                $facturaDetalle->save();
            }
        });

        return response()->json('Ok');
    }

    public function show($id)
    {
        $factura = Factura::query()
            ->with('detalles.producto')
            ->with('usuario')
            ->with('estado')->findOrFail($id);

        return Inertia::render('Facturas/Show', ['factura' => $factura]);
    }

    public function update(Request $request, Factura $factura)
    {

    }

    public function edit($id)
    {
        $factura = Factura::query()
            ->with('detalles.producto')
            ->with('usuario')
            ->with('estado')->findOrFail($id);

        $estados = Estado::all();

        return Inertia::render('Facturas/Edit', ['factura' => $factura, 'estados' => $estados]);
    }
}
