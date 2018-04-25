<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        //$this->assertTrue(true);
        //register
        $response = $this->get('/register');
        $response->assertStatus(403);

        //login test
        $response = $this->get('/login');
        $response->assertStatus(200);

        $username = 'admin';
        $password = 'admin';
        Session::start();
        $response = $this->followingRedirects()->call('POST', '/login', [
            'username' => $username,
            'password' => $password,
            '_token' => csrf_token()
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        //register admin
        $response = $this->get('/register');
        $response->assertStatus(200);

        $response = $this->followingRedirects()->call('POST', '/logout',[
            '_token' => csrf_token()
        ]);

        $this->assertEquals(200, $response->getStatusCode());

    }
}
