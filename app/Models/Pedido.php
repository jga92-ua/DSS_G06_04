<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'cliente_id',
        'cesta_id',
        'direccion_envio',
        'nombre_cliente',
        'metodo_pago',
        'fecha_pedido',
        'comprador_id',
    ];

    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function comprador()
    {
        return $this->belongsTo(User::class, 'comprador_id');
    }

    public function cesta()
    {
        return $this->belongsTo(Cesta::class);
    }
}
