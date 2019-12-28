<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property $user_id
 * @property $message
 *
 * Class Message
 * @package App
 */
class Message extends Model
{
    protected $fillable = [
        'user_id', 'message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
