<?php

namespace Tests\Feature\Domain\User\DTO;

use Domain\User\DTO\NewUserDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class NewUserDtoTest extends TestCase
{
    use RefreshDatabase;

    public function test_instance_created_from_form_request(): void
    {
        $dto = NewUserDTO::formRequest(new Request([
            'nickName' => 'test',
            'email' => 'testing@mail.com',
            'password' => 123456,
        ]));

        $this->assertInstanceOf(NewUserDTO::class, $dto);

    }
}
