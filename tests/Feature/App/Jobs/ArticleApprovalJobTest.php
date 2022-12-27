<?php

namespace Tests\Feature\App\Jobs;

use App\Http\Controllers\Admin\ArticleController;
use App\Jobs\ArticleApprovalJob;
use Database\Factories\Domain\Information\Models\ArticleFactory;
use Database\Factories\Domain\User\Models\UserFactory;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Support\Enums\ArticleStatus;
use Tests\TestCase;

class ArticleApprovalJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_notify_user_success(): void
    {
        $queue = Queue::getFacadeRoot();

        Queue::fake([ArticleApprovalJob::class]);

        $user = UserFactory::new()
            ->createOne();

        $article = ArticleFactory::new()
            ->createOne([
                'status' => ArticleStatus::NEW,
                'user_id' => $user->getKey()
            ]);

        $this->post(action([ArticleController::class, 'approve'], $article->getKey()));

        $currentUser = User::find($article->user_id);

        Queue::swap($queue);

        ArticleApprovalJob::dispatchSync($currentUser);

        $this->assertDatabaseHas('articles', [
            'id' => $article->getKey(),
            'status' => ArticleStatus::APPROVED
        ]);
    }
}
