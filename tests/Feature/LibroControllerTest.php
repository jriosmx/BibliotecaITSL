<?php

namespace Tests\Feature;

use App\Http\Controllers\LibroController;
use App\Models\Libro;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LibroControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_libro_store()
    {
        /* $this->withoutExceptionHandling();

        $url = route('libros.store');
        
        $values = [
            'ISBN'                => '9780132350884',
            'titulo'              => 'Clean Code: A Handbook of Agile Software Craftsmanship',  
            'fechaDeLanzamiento'  => '2008-08-10',
            'autor'               => 'Robert Martin',
            'categoria'           => 'programacion',
            'editorial'           => 'Alianza',
            'idioma'              => 'espanol',
            'pagina'              => '431',
            'descripcion'         => 'Even bad code can function. But if code isnt clean, it can bring a development organization to its knees. Every year, countless hours and significant resources are lost because of poorly written code. But it doesnt have to be that way.' 
        ];

        $this->post($url, $values)
             ->assertStatus(302);
            //  ->assertRedirect(action([AutorController::class, 'index']));

        // $this->assertDatabaseHas(Libro::class, $values); */
    }
}
