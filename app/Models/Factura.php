<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function detalles()
    {
        return $this->hasMany(FacturaDetalle::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }
}
