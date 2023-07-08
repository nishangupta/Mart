<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CartControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function userCanManageCart()
    {
        Artisan::call('db:seed');
        Auth::loginUsingId(3); //user according to the seeder
        $this->post(route('cart.store'), [
            'product_id' => 1,
            'quantity' => 2,
        ]);

        // successfully added to the cart
        $this->assertDatabaseCount(Cart::class, 1);

        // removing cart items
        $this->post('/cart/destroy/selected', ['cart' => [1]])
            ->assertJson(['delete' => 'success']);
    }

    #[Test]
    public function userGetsHisCartItemsOnly()
    {
        Artisan::call('db:seed');
        Auth::loginUsingId(3); //user according to the seeder

        $this->post(route('cart.store'), [
            'product_id' => 1,
            'quantity' => 2,
        ]);

        $this->get('/cart/api/all')
            ->assertJson([
                ['user_id' => '3'], //same as the auth user id
            ]);
    }
}
