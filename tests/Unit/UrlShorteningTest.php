<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Url;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UrlShorteningTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function any_user_can_shorten_url()
    {
        $this->post('/url/shorten', [
            'original_url' => 'https://example.com',
        ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('urls', ['original_url' => 'https://example.com']);
    }

    /** @test */
    public function authenticated_user_can_shorten_url()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/url/shorten', [
                'original_url' => 'https://example.com',
            ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('urls', ['original_url' => 'https://example.com']);
    }

    /** @test */
    public function authenticated_user_can_see_dashboard()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewIs('dashboard');
        $response->assertSee('Manage Your URLs');
    }

    /** @test */
    public function authenticated_user_can_delete_url()
    {
        $user = User::factory()->create();
        $url = Url::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete('/url/delete/' . $url->id);

        $this->assertDatabaseMissing('urls', ['id' => $url->id]);

        $response->assertRedirect('/dashboard');
        $response->assertSessionHas('success', 'URL deleted successfully!');
    }

    /** @test */
    public function unauthorized_user_cannot_delete_url()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $url = Url::factory()->create(['user_id' => $user1->id]);

        $response = $this->actingAs($user2)->delete('/url/delete/' . $url->id);

        $this->assertDatabaseHas('urls', ['id' => $url->id]);

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Unauthorized action!');
    }

    /** @test */
    public function short_url_redirects_to_original_url()
    {
        $user = User::factory()->create();
        $url = Url::factory()->create(['user_id' => $user->id]);

        $response = $this->get('/url' . '/' . $url->short_url);

        $response->assertRedirect($url->original_url);
    }

    /** @test */
    public function test_invalid_url_cannot_be_shortened()
    {
        $this->post('/url/shorten', [
            'original_url' => 'invalid-url',
        ])
            ->assertSessionHasErrors();
    }
}
