<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CustomerQuestion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CustomerQuestionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function onlyAdminsCanGoToAdminView()
    {
        Artisan::call('db:seed');
        Auth::loginUsingId(1); //admin according to the seeder

        $response = $this->get('/admin/customer-question');
        $response->assertStatus(200);
    }
    /** @test */
    public function usersAreRestrictedToGoToAdminView()
    {
        Artisan::call('db:seed');
        Auth::loginUsingId(2); //user according to the seeder

        $response = $this->get('/admin/customer-question');
        $response->assertForbidden();
    }

    /** @test */
    public function userCanStoreQuestionToProduct()
    {
        Artisan::call('db:seed');
        Auth::loginUsingId(2); //user according to the seeder

        $response = $this->post('/customer-question', [
            'question' => 'Is is good?',
            'product_id' => 1
        ]);
        $response->assertStatus(302);
        $this->assertCount(1, CustomerQuestion::all());
    }
}
