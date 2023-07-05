<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AboutTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    /**
     * A Dusk test example.
     */
    public function testStaff(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/about/staff')
                ->assertSee('Dirección');
        });
    }
}
