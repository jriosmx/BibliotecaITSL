<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    // use refreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_store()
    {
        $this->withoutExceptionHandling();

        $url = route('users.store');
        
        $values = [
            'nombre'     => 'Jesus',           
            'apellidos'  => 'Rios',
            'username'   => 'jR', 
            'email'      => 'tux_rios@hotmail.com',
            'password'   => '12345' 
        ];

        $this->post($url, $values)
             ->assertStatus(302);
            //  ->assertRedirect(action([AutorController::class, 'index']));

        // $this->assertDatabaseHas(User::class, $values);
    }
}
