<?php

namespace App\Repositories;

use App\Models\UserSetting;

interface UserSettingRepositoryInterface
{
    /***
     * Update user setting by key
     * @param int $user_id
     * @param array $data
     * @return array
     */
    public function updateSetting(int $user_id, array $data): array;
}
