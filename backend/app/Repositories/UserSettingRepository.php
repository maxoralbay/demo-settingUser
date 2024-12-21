<?php

namespace App\Repositories;

use App\Models\UserSetting;
use App\Repositories\UserSettingRepositoryInterface;

class UserSettingRepository implements UserSettingRepositoryInterface
{

    public function getSettingByKey($user_id)
    {
        // TODO: Implement getSettingByKey() method.
        return UserSetting::where('user_id', $user_id)->first();

    }

    public function updateSetting($user_id, $data)
    {
        // TODO: Implement updateSetting() method.
        // Ensure key and value are provided and not null
        if (is_null($data['key1']) || is_null($data['key2'])) {
            throw new \InvalidArgumentException('Key and value cannot be null.');
        }
        UserSetting::updateOrCreate(
            ['user_id' => $user_id],
            ['key1' => $data['key1'], 'key2' => $data['key2']],
        );


    }
}
