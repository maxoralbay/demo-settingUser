<?php

namespace App\Repositories;

interface NotificatorRepositoryInterface
{
    // send notification
    // @param string $message
    // @return true|false
    public function send(string $message, array $opts): bool;
}
