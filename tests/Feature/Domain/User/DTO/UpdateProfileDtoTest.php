<?php

namespace Tests\Feature\Domain\User\DTO;

use Domain\User\DTO\UpdateProfileDto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Tests\TestCase;

class UpdateProfileDtoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_instance_created_from_form_request(): void
    {
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
