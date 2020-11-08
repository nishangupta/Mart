<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class AccountControllerTest extends TestCase
{
  use RefreshDatabase, WithFaker;

  /** @test */
  public function userCanLogout()
  {
    $response = $this->get('/logout');
    $response->assertRedirect('/login');
  }

  /** @test */
  public function NonAuthenticatedUserCannotChangePassword()
  {
    $response = $this->from('/user')->put('/account/changePassword', [
      'current_password' => 'asdasdasd',
      'new_password' => 'asdasdasdasd',
      'confirmation_password' => 'asdasdasdasd'
    ]);

    $response->assertRedirect('/user');
    $this->assertGuest();
  }

  /** @test */
  public function userCanChangePassword()
  {
    Artisan::call('db:seed', ['--class' => 'RoleSeeder']);
    User::factory(1)->create();
    $user = User::first();
    $oldp = $user->password;
    $this->be($user);

    $response = $this->put('/account/changePassword', [
      'current_password' => 'password',
      'new_password' => 'newpassword',
      'confirm_password' => 'newpassword'
    ]);

    $this->assertTrue(Hash::check('newpassword', User::first()->password));
  }
}
