<?php

namespace App\Repositories;

use App\Models\UserSetting;

interface UserSettingRepositoryInterface
{
    // get setting by user key
    public function getSettingByKey(int $user_id);

    // update setting by user key
    public function updateSetting(int $user_id, array $data);
}
