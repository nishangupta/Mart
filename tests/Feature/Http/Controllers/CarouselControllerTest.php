<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CarouselControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function loadCarouselManagementPage()
    {
        Artisan::call('db:seed');
        Auth::loginUsingId(1); // admin according to seeder
        $response = $this->get('/carousel');

        $response->assertOk();
    }
    /** @test */
    public function usersAreForbiddenToVisitCarouselPage()
    {
        Artisan::call('db:seed');
        Auth::loginUsingId(2); //user according to the seeder

        $response = $this->get('/carousel');
        $response->assertForbidden();
    }
}
