<?php

namespace Domain\User\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function register(): void
    {
        $this->app->register(
            ActionsServiceProvider::class,
        );
    }

    public function boot(): void
    {
        $this->registerPolicies();

        VerifyEmail::toMailUsing(fn($notifiable, $url) =>
            (new MailMessage)
                ->subject(trans('email-verification.subject'))
                ->line(trans('email-verification.line'))
                ->action(trans('email-verification.text'), $url));
    }
}
