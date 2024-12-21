<?php

namespace App\Repositories;

use App\Models\UserSetting;

interface UserSettingRepositoryInterface
{
    // update setting by user key
    public function updateSetting(int $user_id, array $data): array;
}
