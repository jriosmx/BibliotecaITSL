<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected $table = 'Autores';

    protected $fillable = [
        'autor',        
    ];

    public function libros(){
        return $this->hasMany(Libro::class);
    }
}
