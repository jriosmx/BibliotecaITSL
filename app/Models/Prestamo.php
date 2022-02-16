<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $table = 'Prestamos';

    protected $fillable = [
        'numCont',
        'idMast',  
        'idLibro',
        'idTipoPrestamo',
        'fechaPrestamo',
        'horaPrestamo',
        'fechaEntrega',
        'horaEntrega',
        'observaciones'      
    ];

    public function libro(){
        return $this->belongsTo(Libro::class);
    }

    public function tipoPrestamo(){
        return $this->belongsTo(TipoPrestamo::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
