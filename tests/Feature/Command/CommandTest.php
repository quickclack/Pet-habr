<?php

namespace Tests\Feature\Command;

use Tests\TestCase;

class CommandTest extends TestCase
{
    public function test_install_command(): void
    {
        $this->artisan('project:install')
            ->assertSuccessful();
    }

    public function test_refresh_command(): void
    {
        $this->artisan('project:refresh')
            ->assertSuccessful();
    }
}
