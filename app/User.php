<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\CaptureIpTrait;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'signup_ip',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'role_id',
    ];

    public static function boot() {
        parent::boot();

        static::creating( function($user) {
            $user->token = str_random(64);
        });
    }

    public function hasVerified() {
        $ipAddress = new CaptureIpTrait;
        $this->active = true;
        $this->token = null;
        $this->confirm_ip = $ipAddress->getClientIp();
        
        $this->save();
    }

}
