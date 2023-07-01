<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
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
