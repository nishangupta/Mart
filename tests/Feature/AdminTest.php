<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function AdminsAreRedirectedToHomeAfterLogin()
    {
        Artisan::call('db:seed');
        // login as admin
        $response = $this->from('/login')->post('/login', [
            'email' => 'admin@admin.com',
            'password' => 'password'
        ]);

        $this->assertTrue(Auth::check());
        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }
}
