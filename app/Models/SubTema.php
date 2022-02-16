<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTema extends Model
{
    use HasFactory;
    protected $table = 'SubTemas';

    protected $fillable = [
        'idTema',
        'nombre',
        'pagina',                
    ];

    public function libro(){
        return $this->belongsTo(Libro::class);
    }

    public function tema(){
        return $this->belongsTo(Tema::class);
    }

    public function consultas(){
        return $this->hasMany(Consultas::class);
    }
}
