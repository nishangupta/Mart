<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DirectBuyTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function userCanPlaceOrder()
    {
        Artisan::call('db:seed');

        Auth::loginUsingId(2); // default user from user seeder

        $this->post('/direct-buy', ['id' => 1]);

        $this->assertDatabaseCount(Order::class, 1);
        $this->assertDatabaseHas(Order::class, [
            'user_id' => 2,
            'product_id' => 1,
            'quantity' => 1,
        ]);
    }
}
