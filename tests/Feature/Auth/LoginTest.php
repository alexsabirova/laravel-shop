<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_login_redirect_to_home_page_successfully(): void
    {
        $user = User::factory(User::class)->create([
            'name' => 'Test User',
            'email' => 'test@email.com',
            'password' => Hash::make('123123123'),
        ]);

        $response = $this->post('/login', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => '123123123',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }
}
