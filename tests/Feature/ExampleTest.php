<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_invitation_renders_background_music_player(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('id="wedding-music"', false);
        $response->assertSee('id="music-toggle-btn"', false);
        $response->assertSee('Rizky Febian Feat. Mahalini - Bermuara', false);
    }
}
