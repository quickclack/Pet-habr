<?php

namespace Support\Logging\Telegram;

use App\Jobs\TelegramLoggerJob;
use Illuminate\Support\Facades\Schema;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

final class TelegramLoggerHandler extends AbstractProcessingHandler
{
    protected int $chatId;
    protected string $token;

    public function __construct(array $config)
    {
        $level = Logger::toMonologLevel($config['level']);

        parent::__construct($level);

        $this->chatId = (int) $config['chat_id'];
        $this->token = $config['token'];
    }

    protected function write(array $record): void
    {
        if (Schema::hasTable('job')) {
            dispatch(new TelegramLoggerJob($this->token, $this->chatId, $record['formatted']))
                ->delay(now()->addSeconds(10));
        }
    }
}
