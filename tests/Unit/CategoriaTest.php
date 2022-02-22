<?php

namespace Tests\Unit;

use App\Models\Categoria;
use Tests\TestCase;

class CategoriaTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_categoria_create()
    {
        $this->withoutExceptionHandling();

        $values = [
            'categoria' => 'texto'
        ];

        $categoria = new Categoria($values);
        
        $this->assertEquals('texto', $categoria->categoria);            
    }
}
