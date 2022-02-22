<?php

namespace Tests\Unit;

use App\Models\Libro;
use App\Models\User;
use Tests\TestCase;

class LibroTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_libro()
    {
        $this->withoutExceptionHandling();
        
        
    
        // User::factory()->create();

        $id = 1;
        $libro = Libro::find($id);
        $url = route('libros.edit', compact('libro'));
        
        
        $this->get($url)
             ->assertStatus(200);
            //  ->assertRedirect(action([AutorController::class, 'index']));

        // $this->assertDatabaseHas(User::class, $values);  
    }
}
