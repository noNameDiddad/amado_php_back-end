<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testRegister()
    {
        $response = $this->post('/register', [
            'name' => 'test',
            'email' => 'test@test.test',
            'password' => 'test',
            'password_confirm' => 'test',
        ]);
        $response->assertRedirect('/login');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAuthorize()
    {
        $response = $this->post('/login', [
            'email' => 'test@test.test',
            'password' => 'test',
        ]);
        $response->assertRedirect('/persona');
    }

}
