<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;


    public function test_ログイン画面を表示できる(): void
    {
        // Act
        $response = $this->get(route('login'));

        // Assert
        $response->assertStatus(200);
    }


    public function test_正しい認証情報でログインできる(): void
    {
        // Arrange
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        // Act
        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        // Assert
        $response->assertRedirect(route('tasks.index'));
        $this->assertAuthenticatedAs($user);
    }


    public function test_間違ったパスワードではログインできない(): void
    {
        // Arrange
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        // Act
        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        // Assert
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }


    public function test_存在しないメールアドレスではログインできない(): void
    {
        // Act
        $response = $this->post(route('login'), [
            'email' => 'nonexistent@example.com',
            'password' => 'password123',
        ]);

        // Assert
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }


    public function test_メールアドレスが空だとバリデーションエラーになる(): void
    {
        // Act
        $response = $this->post(route('login'), [
            'email' => '',
            'password' => 'password123',
        ]);

        // Assert
        $response->assertSessionHasErrors('email');
    }


    public function test_パスワードが空だとバリデーションエラーになる(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => '',
        ]);

        // Assert
        $response->assertSessionHasErrors('password');
    }


    public function test_ログアウトできる(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)->post(route('logout'));

        // Assert
        $response->assertRedirect('/');
        $this->assertGuest();
    }


    public function test_認証済みユーザーはログインページにアクセスするとリダイレクトされる(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)->get(route('login'));

        // Assert
        $response->assertRedirect(route('tasks.index'));
    }

    public function test_guest_cannot_access_dashboard(): void
    {
        // Arrange
        $user = User::factory()->create();
        // Act
        $response = $this->get('/dashboard');
        // Assert
        $response->assertRedirect('/login');

    }
}
