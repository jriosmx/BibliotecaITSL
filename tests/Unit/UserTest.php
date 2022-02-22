<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_autor_create()
    {
        $this->withoutExceptionHandling();

        $values = [
            'nombre'     => 'Jose',           
            'apellidos'  => 'Perez',
            'username'   => 'pp', 
            'email'      => 'inventado@hotmail.com',
            'password'   => '12345'   
        ];

        $user = new User($values);
        
        $this->assertEquals('pp', $user->username);
            
    }
}
