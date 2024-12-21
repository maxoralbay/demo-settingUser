<?php

namespace App\Repositories;

use App\Models\Notificatior;
use App\Repositories\NotificationRepository\EmailNotificator;
use App\Repositories\NotificationRepository\SmsNotificator;
use App\Repositories\NotificationRepository\TelegramNotificator;
use App\Repositories\NotificatorRepositoryInterface;

/***
 * send message by method (message, opts)
 * Send notification by method (use email, telegram, sms Notification Repository)
 */
class Notificator
{
    private $message;
    private $opts;
    private $method;

    public function __construct($user_id, $method)
    {
        $this->user_id = $user_id;
        $this->method = $method;

    }

    /***
     * Send message
     * @param $message
     * @param $opts
     * @return bool
     */
    public function sendMessage($message, $opts): bool
    {
        // prepare code
        // create Notification
        Notificatior::create([
            'user_id' => $this->user_id,
            'method' => $this->method,
            'message' => $message,
            'opts' => json_encode($opts),
        ]);
        // todo: send code through method [email, sms, telegram] use Notification Repository
        return $this->provider($this->method)->send($message, $opts);


    }

    /***
     * Get provider
     * @param string $method
     * @return mixed|null
     */
    public function provider(string $method)
    {
        // get provider
        $provider = [
            'email' => new EmailNotificator(),
            'sms' => new SmsNotificator(),
            'telegram' => new TelegramNotificator(env('TELEGRAM_API_URL', 'https://api.telegram.org/bot')),
        ];
        return $provider[$method] ?? null;
    }


}
