<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cesta extends Model
{
    protected $fillable = ['user_id'];

    public function items()
    {
        return $this->hasMany(CestaItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
