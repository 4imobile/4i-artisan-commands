<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Device extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'device_id', 'type', 'version', 'push_token'
    ];

    protected $hidden = [
        'version'
    ];

    public function setAccessToken() {
        $this->access_token = (string) Uuid::uuid4();
    }

    public function getAccessToken() {
        return $this->access_token;
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
