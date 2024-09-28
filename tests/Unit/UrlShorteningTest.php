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
    public function authenticated_user_can_shorten_url()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/urls', [
                'original_url' => 'https://example.com',
            ])
            ->assertStatus(302) // Redirect after storing
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('urls', ['original_url' => 'https://example.com']);
    }

    /** @test */
    public function unauthenticated_user_cannot_access_url_creation_form()
    {
        $this->get('/urls/create')
            ->assertRedirect('/login');
    }
}
