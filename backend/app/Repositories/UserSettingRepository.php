<?php

namespace App\Repositories;

use App\Models\Notificatior;
use App\Models\UserSetting;
use App\Repositories\UserSettingRepositoryInterface;

class UserSettingRepository implements UserSettingRepositoryInterface
{
    /***
     * Get user setting by key
     * @param $user_id
     * @param $data
     * @return array
     */
    public function updateSetting($user_id, $data): array
    {
        // TODO: Implement updateSetting() method.
        // Ensure key and value are provided and not null
        if (is_null($data['key1']) || is_null($data['key2'])) {
            throw new \InvalidArgumentException('Key and value cannot be null.');
        }
        // check code is valid
        $dbCode = Notificatior::where('user_id', $user_id)->first();
        if ($dbCode->code != $data['code']) {
            return [
                'message' => 'Code is not valid',
                'status' => false
            ];
        }
        UserSetting::updateOrCreate(
            ['user_id' => $user_id],
            ['key1' => $data['key1'], 'key2' => $data['key2']],
        );

        return [
            'message' => 'Setting updated successfully',
            'status' => true
        ];


    }
}
