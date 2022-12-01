<?php

namespace Tests\Feature\Domain\User\DTO;

use Domain\User\DTO\UpdateProfileDto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UpdateProfileDtoTest extends TestCase
{
    use RefreshDatabase;

    public function test_instance_created_from_form_request(): void
    {
        Storage::fake('public');

        $dto = UpdateProfileDto::formRequest(new Request([
            'firstName' => 'test',
            'lastName' => 'testov',
            'description' => 'tester',
            'sex' => 'male',
            'avatar' => UploadedFile::fake()->image('image.jpg', 1, 1)
        ]));

        $this->assertInstanceOf(UpdateProfileDto::class, $dto);
    }
}
