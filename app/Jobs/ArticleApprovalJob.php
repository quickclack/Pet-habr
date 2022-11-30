<?php

namespace App\Jobs;

use App\Notifications\ArticleApprovalNotification;
use Domain\User\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ArticleApprovalJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected User $user)
    {
    }

    public function handle()
    {
        $this->user->notify(new ArticleApprovalNotification());
    }

    public function uniqueId(): mixed
    {
        return $this->user->getKey();
    }
}
