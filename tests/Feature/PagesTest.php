<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PagesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_homepage_returns_a_successful_respone()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
