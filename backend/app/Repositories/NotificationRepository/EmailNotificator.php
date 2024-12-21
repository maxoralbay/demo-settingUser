<?php

namespace App\Repositories\NotificationRepository;

use App\Repositories\NotificatorRepositoryInterface;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

// php mailer
class EmailNotificator implements NotificatorRepositoryInterface
{
    // send notification

    public function send(string $message, array $opts): bool
    {
        try {
            // $opts = ['name' => 'name', 'email' => 'email']
            // merge message with opts
            $opts['message'] = $message;
            Mail::to($opts['email'])->send(new Notification($opts));
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

}
