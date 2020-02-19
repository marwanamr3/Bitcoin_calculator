<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;

//use Tests\TestCase;

abstract class ExampleTest extends TestCase
{

    public function testBasicTest()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function getViewTest()
    {
        $response = $this->get('/');

        $response->assertResponseOk();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function post_dates_test()
    {
        $response = $this->post('/info', [
            'from' => '2019-02-03',
            'to' => '2019-03-04'
        ]);

        $response->assertResponseOk();
    }
}
