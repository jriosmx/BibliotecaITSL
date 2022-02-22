<?php

namespace Tests\Unit;

use App\Models\Autor;
use Tests\TestCase;

class AutorTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_autor_create()
    {
        $this->withoutExceptionHandling();

        $values = [
            'autor' => 'Jose'
        ];

        $autor = new Autor($values);
        
        $this->assertEquals('Jose', $autor->autor);
            
    }
}
