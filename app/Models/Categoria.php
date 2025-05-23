<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $casts = [
        'id_cartas' => 'array',
    ];

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'id_cartas',
        'created_at',
        'updated_at',
    ];

    public function carta()
    {
        return $this->belongsTo(Carta::class, 'id_cartas');
    }
}
