<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;
    
    protected $table = 'Consultas';

    protected $fillable = [
        'idLibro',
        'numCont',
        'idMast',  
        'idSubTema',  
        'fechaConsulta'            
    ];

    public function libro(){
        return $this->belongsTo(Libro::class);
    }

    public function subtema(){
        return $this->belongsTo(SubTema::class);
    }
}
