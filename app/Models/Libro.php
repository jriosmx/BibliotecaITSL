<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $table = 'Libros';

    protected $fillable = [
        'ISBN',
        'titulo',  
        'fechaDeLanzamiento',
        'idAutor',
        'idCategoria',
        'idEditorial',
        'idioma',
        'pagina',
        'descripcion',
        'portada'      
    ];


    public function autor(){
        return $this->belongsTo(Autor::class);
    }

    public function categoria(){
        return $this->belongsTo(Autor::class);
    }

    public function editorial(){
        return $this->belongsTo(Editorial::class);
    }

    public function existencia(){
        return $this->belongsTo(Autor::class);
    }

    public function temas(){
        return $this->hasMany(Tema::class);
    }

    public function prestamos(){
        return $this->hasMany(Prestamo::class);
    }



    


}
