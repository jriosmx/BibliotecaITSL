<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_login()
    {
       
        $this->withoutExceptionHandling();

        $url = route('login');
        
        $values = [
            'email'    => 'tux_rios@hotmail.com',                     
            'password' => '12345'            
        ];

        $this->post($url, $values)
             ->assertStatus(302);
            //  ->assertRedirect(action([AutorController::class, 'index']));

        // $this->assertDatabaseHas(User::class, $values);   
    }
}
