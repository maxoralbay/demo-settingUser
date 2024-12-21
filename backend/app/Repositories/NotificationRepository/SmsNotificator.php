<?php

namespace App\Repositories\NotificationRepository;

use App\Repositories\NotificatorRepositoryInterface;

class SmsNotificator implements NotificatorRepositoryInterface
{
    public function send(string $message, array $opts): bool
    {
        // send sms
        return true;
    }

}
