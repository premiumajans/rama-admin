<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ForignerControllerTest extends TestCase
{
    public function test_load_page()
    {
        $response = $this->get('/admin/forigners');

        $response->assertStatus(200);
    }
}
