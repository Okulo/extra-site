<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class BoardTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_get_boards()
    {
        echo "Test GET Boards\n";
        $this->call('GET', '/home/getBoards');
        $this->assertNotEmpty('data');
    }
}
