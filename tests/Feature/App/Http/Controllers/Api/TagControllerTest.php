<?php

namespace Tests\Feature\App\Http\Controllers\Api;

use App\Http\Controllers\Api\TagController;
use Database\Factories\Domain\Information\Models\TagFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_tags_success(): void
    {
        TagFactory::new()
            ->count(5)
            ->create();

        $this->post(action([TagController::class, 'getAllTags']))
            ->assertOk()
            ->assertJsonCount(1);
    }
}
