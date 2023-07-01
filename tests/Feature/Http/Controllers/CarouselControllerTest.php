<?php

namespace Tests\Feature\Http\Controllers;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CarouselControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function loadCarouselManagementPage()
    {
        Artisan::call('db:seed');
        Auth::loginUsingId(1); // admin according to seeder
        $response = $this->get('/carousel');

        $response->assertOk();
    }

    #[Test]
    public function usersAreForbiddenToVisitCarouselPage()
    {
        Artisan::call('db:seed');
        Auth::loginUsingId(2); //user according to the seeder

        $response = $this->get('/carousel');
        $response->assertForbidden();
    }
}
