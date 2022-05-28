<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacturaStoreRequest;
use App\Models\Factura;
use App\Models\FacturaDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturasController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
                
                if($cantidad <= 0){
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
