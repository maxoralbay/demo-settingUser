<?php

namespace Database\Seeders;

use App\Models\UserSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = \App\Models\User::all();
        foreach ($users as $user) {
            UserSetting::create([
                'user_id' => $user->id,
                'key' => 'notifications',
                'value' => 'email',
            ]);
            UserSetting::create([
                'user_id' => $user->id,
                'key' => 'notifications',
                'value' => 'sms',
            ]);
            UserSetting::create([
                'user_id' => $user->id,
                'key' => 'notifications',
                'value' => 'telegram',
            ]);
        }
    }
}
