<?php

namespace Tests\Feature\App\Console\Command;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_install_command()
    {
        $this->artisan('project:install')
            ->assertSuccessful();
    }
}
