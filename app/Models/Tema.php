<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;

    protected $table = 'Temas';

    protected $fillable = [
        'idLibro',
        'tema',
        'paginas',                
    ];

    public function libro(){
        return $this->belongsTo(Libro::class);
    }

    public function subtemas(){
        return $this->hasMany(SubTemas::class);
    }
}
