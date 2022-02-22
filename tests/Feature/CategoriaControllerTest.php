<?php

namespace Tests\Feature;

use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriaControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_categoria_store()
    {
        $this->withoutExceptionHandling();

        $url = route('categorias.store');
        
        $values = [
            'categoria' => 'programacion'             
        ];

        $this->post($url, $values)
             ->assertStatus(302);
            //  ->assertRedirect(action([AutorController::class, 'index']));

        $this->assertDatabaseHas(Categoria::class, $values);
    }
}
