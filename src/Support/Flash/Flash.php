<?php

namespace Support\Flash;

use Illuminate\Contracts\Session\Session;

final class Flash
{
    public const MESSAGE_KEY = 'project_flash_message';
    public const MESSAGE_CLASS_KEY = 'project_flash_class';

    public function __construct(protected Session $session)
    {
    }

    public function get(): ?FlashMessage
    {
        $message = $this->session->get(self::MESSAGE_KEY);

        if (!$message) {
            return null;
        }

        return new FlashMessage(
            $message,
            $this->session->get(self::MESSAGE_CLASS_KEY)
        );
    }

    public function error(string $message): void
    {
        $this->flash($message, 'error');
    }

    public function success(string $message): void
    {
        $this->flash($message, 'success');
    }

    public function message(string $message): void
    {
        $this->flash($message, 'message');
    }

    private function flash(string $message, string $name): void
    {
        $this->session->flash(self::MESSAGE_KEY, $message);
        $this->session->flash(self::MESSAGE_CLASS_KEY, config("flash.$name", ''));
    }
}
