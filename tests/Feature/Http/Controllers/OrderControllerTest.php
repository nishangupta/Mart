<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function userCanPlaceOrder()
    {
        Artisan::call('db:seed');
        Auth::loginUsingId(2); //default user from user seeder

        $response = $this->post('/direct-buy', [
            'id' => 1
        ]);

        $this->assertCount(1, Order::all());
    }
}
