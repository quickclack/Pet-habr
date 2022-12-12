<?php

namespace Tests;

use App\Http\Middleware\Admin;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Storage;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');

        $this->withoutMiddleware(Admin::class);

        $this->withoutVite();
    }
}
