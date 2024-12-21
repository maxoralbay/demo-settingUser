<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Repositories\UserSettingRepositoryInterface;
use App\Repositories\UserSettingRepository;
use App\Repositories\NotificationRepository\TelegramNotificator;
use App\Repositories\NotificationRepository\EmailNotificator;
use App\Repositories\NotificationRepository\SmsNotificator;
use App\Repositories\NotificatorRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(UserSettingRepositoryInterface::class, UserSettingRepository::class);
        // bind EmailNotificator,  to NotificationRepositoryInterface
        $this->app->bind(NotificatorRepositoryInterface::class, EmailNotificator::class);
        $this->app->bind(NotificatorRepositoryInterface::class, SmsNotificator::class);
        $this->app->bind(NotificatorRepositoryInterface::class, TelegramNotificator::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
