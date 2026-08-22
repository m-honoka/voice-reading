<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;
    public function test_authenticated_user_can_access_home(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_guest_cannot_access_home(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/login');
    }

    public function test_home_page_contains_textarea_and_read_button(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('読み上げたい文章を入力してください。');
        $response->assertSee('読み上げる');
    }
}