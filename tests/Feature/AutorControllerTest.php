<?php

namespace Tests\Feature;

use App\Http\Controllers\AutorController;
use App\Models\Autor;
use Tests\TestCase;

class AutorControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_autor_store()
    {
        $this->withoutExceptionHandling();

        $url = route('autores.store');
        
        $values = [
            'autor' => 'Robert Martin'
        ];

        $this->post($url, $values)
             ->assertStatus(302);
            //  ->assertRedirect(action([AutorController::class, 'index']));

        $this->assertDatabaseHas(Autor::class, $values);
    }
}
