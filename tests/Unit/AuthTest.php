<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    public function test_user_can_view_login_form()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_user_can_login_with_valid_credentials()
    {
        Company::factory()->create();
        $user = User::factory()->create([
            'full_name' => 'first_name',
            'email' => 'test@test.com',
            'role_id' => 2,
            'password' => Hash::make('password123')
        ]);

        $response = $this->post('api/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cant_login_with_invalid_credentials()
    {
        Company::factory()->create();
        $user = User::factory()->create([
            'full_name' => 'first_name',
            'email' => 'test@test.com',
            'role_id' => 2,
            'password' => Hash::make('password123')
        ]);

        $wrong_password = [
            'email' => $user->email,
            'password' => 'wrong password',
        ];

        $wrong_email = [
            'email' => 'wrong@email.com',
            'password' => 'password123',
        ];

        $this->assertInvalidCredentials($wrong_password);
        $this->assertInvalidCredentials($wrong_email);
    }
}
