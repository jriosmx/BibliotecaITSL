<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPrestamo extends Model
{
    use HasFactory;

    protected $table = 'TipoPrestamos';

    protected $fillable = [
        'tipoPrestamo',          
    ];

    public function prestamos(){
        return $this->hasMany(Prestamo::class);
    }
}
