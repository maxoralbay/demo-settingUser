<?php

namespace App\Repositories;

interface NotificatorRepositoryInterface
{
    /***
     * Send message
     * @param string $message
     * @param array $opts
     * @return bool
     */
    public function send(string $message, array $opts): bool;
}
