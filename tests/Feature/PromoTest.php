<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class PromoTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_promo_is_shown_on_both_sides(): void
    {
        $this->get('/')
            ->assertSee('rail-left')
            ->assertSee('rail-right');  
    }

    public function test_every_promo_links_to_a_real_page_and_has_a_photo(): void
    {
        foreach (config('promos') as $promo) {
            $this->assertTrue(Route::has($promo['route']));
            $this->assertFileExists(public_path($promo['image']));
        }
    }
}