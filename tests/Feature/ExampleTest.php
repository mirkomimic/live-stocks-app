<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia as Assert;

class ExampleTest extends TestCase
{
  /**
   * A basic test example.
   */
  public function test_the_application_returns_a_successful_response(): void
  {
    $response = $this->get('/');

    $response->assertSee('Home');

    $response->assertStatus(200);
  }

  public function test_can_view_data(): void
  {
    $response = $this->get('/data');

    $response->assertSee('Data/Earnings');

    $response->assertStatus(200);
  }
}
