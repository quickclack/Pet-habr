<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Services\Telegram\TelegramBotApi;

class TelegramLoggerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        protected string $token,
        protected int $chatId,
        protected string $text
    ){
    }

    public function handle(): void
    {
        TelegramBotApi::sendMessage($this->token, $this->chatId, $this->text);
    }
}
