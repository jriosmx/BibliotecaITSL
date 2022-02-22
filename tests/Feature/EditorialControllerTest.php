<?php

namespace Tests\Feature;

use App\Models\Editorial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditorialControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_editorial_store()
    {
        $this->withoutExceptionHandling();

        $url = route('editoriales.store');
        
        $values = [
            'editorial' => 'Alianza'             
        ];

        $this->post($url, $values)
             ->assertStatus(302);
            //  ->assertRedirect(action([AutorController::class, 'index']));

        $this->assertDatabaseHas(Editorial::class, $values);
    }
}
