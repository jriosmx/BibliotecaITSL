<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'Categorias';

    protected $fillable = [
        'categoria',          
    ];

    public function libros(){
        return $this->hasMany(Libro::class);
    }
}
