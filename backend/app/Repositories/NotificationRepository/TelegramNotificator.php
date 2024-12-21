<?php

namespace App\Repositories\NotificationRepository;

use App\Repositories\NotificatorRepositoryInterface;
use Illuminate\Support\Facades\Http;

class TelegramNotificator implements NotificatorRepositoryInterface
{
    protected $apiUrl;

    public function __construct(string $apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }

    public function send(string $message, array $opts): bool
    {
        $chatId = $this->getChatId() ?? null;

        if (is_null($chatId)) {
            throw new \InvalidArgumentException('Chat id cannot be null.');
        }

        $response = Http::post($this->apiUrl . '/sendMessage', [
            'chat_id' => $chatId,
            'text' => $message,
        ]);

        return $response->ok();
    }

    public function getChatId(): string
    {
        $response = Http::get($this->apiUrl . "/getUpdates");
        $chatId = $response->json('result.0.message.chat.id');

        return $chatId;
    }

}
