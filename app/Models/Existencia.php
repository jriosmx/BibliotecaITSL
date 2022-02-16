<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Existencia extends Model
{
    use HasFactory;

    protected $table = 'Existencias';

    protected $fillable = [
        'idLibro',
        'cantidad',
        'ubicacion',                
    ];

    public function libro(){
        return $this->belongsTo(Libro::class);
    }
}
