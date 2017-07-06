<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
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
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'role_id',
        'signup_ip',
        'confirm_ip',
        'password',
        'remember_token',
        'token',
        'active',
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

    public function isAdmin(){
        $request=false;
        if ((Auth::user()->role_id) == 3){
            $request=true;
        };
        return $request;
    }

    public function isManager(){
        $request=false;
        if ((Auth::user()->role_id) == 2){
            $request=true;
        };
        return $request;
    }

}
