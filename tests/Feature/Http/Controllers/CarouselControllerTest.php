<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CarouselControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function loadCarouselManagementPage()
    {
        $response = $this->get('/carousel');

        $response->assertOk();
    }
}
