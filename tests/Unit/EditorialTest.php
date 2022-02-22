<?php

namespace Tests\Unit;

use App\Models\Editorial;
use Tests\TestCase;

class EditorialTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_editorial_create()
    {
        $this->withoutExceptionHandling();

        $values = [
            'editorial' => 'Trillas'
        ];

        $editorial = new Editorial($values);
        
        $this->assertEquals('Trillas', $editorial->editorial); 
    }
}
