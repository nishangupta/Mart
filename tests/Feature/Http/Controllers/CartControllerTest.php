<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CartControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function userCanManageCart()
    {
        Artisan::call('db:seed');
        Auth::loginUsingId(2); //user according to the seeder
        $response = $this->post(route('cart.store'), [
            'product_id' => 1,
            'quantity' => 2,
        ]);

        $this->assertCount(1, Cart::all()); //successfully added to the cart

        //removing cart items
        $newResponse = $this->post('/cart/destroy/selected', [
            'cart' => [1]
        ]);

        $newResponse->assertJson(['delete' => 'success']);
    }

    /** @test */
    public function userGetsHisCartItemsOnly()
    {
        Artisan::call('db:seed');
        Auth::loginUsingId(2); //user according to the seeder

        $response = $this->post(route('cart.store'), [
            'product_id' => 1,
            'quantity' => 2,
        ]);

        $response = $this->get('/cart/api/all');
        $response->assertJson([
            ['user_id' => '2'] //same as the auth user id
        ]);
    }
}
