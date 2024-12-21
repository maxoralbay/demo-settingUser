<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'verification_code_id', 'key1', 'key2'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
