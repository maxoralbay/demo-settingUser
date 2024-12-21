<?php

namespace App\Repositories\NotificationRepository;

use App\Repositories\NotificatorRepositoryInterface;
use Twilio\Rest\Client;

class SmsNotificator implements NotificatorRepositoryInterface
{
    protected Client $twilio;

    public function __construct()
    {
        $this->twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    /**
     * Send message
     * @param string $message
     * @param array $opts
     * @return bool
     */
    public function send(string $message, array $opts): bool
    {
        $to = $opts['to'] ?? null;
        $from = env('TWILIO_PHONE_NUMBER'); // Your Twilio phone number

        if (!$to) {
            throw new \InvalidArgumentException("Recipient phone number is required.");
        }

        try {
            $this->twilio->messages->create($to, [
                'from' => $from,
                'body' => $message,
            ]);
            return true;
        } catch (\Exception $e) {
            // Log the error
            \Log::error("Failed to send SMS: " . $e->getMessage());
            return false;
        }
    }
}
