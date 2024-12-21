<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificatior extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'message', 'status', 'method', 'expried_at'];

    public function userSetting()
    {
        return $this->belongsTo(UserSetting::class);
    }

}
