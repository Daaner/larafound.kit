<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

use App\Traits\CaptureIpTrait;
use App\Traits\SaveAvatarTrait;
use App\Traits\GravatarTrait;

use App\Role;
use App\Models\StaticText;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use SaveAvatarTrait;
    use GravatarTrait;

    protected $table = 'users';

    // public $GavatarUrl = GravatarTrait::class;




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

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->token = str_random(64);
        });
    }

    public function hasVerified()
    {
        $ipAddress = new CaptureIpTrait;
        $this->active = true;
        $this->token = null;
        $this->confirm_ip = $ipAddress->getClientIp();

        $this->save();
    }

    // public function getAvatarUrlOrBlankAttribute()
    // {
    //     if (empty($url = $this->avatar)) {
    //       $s = 200;
    //       $d = '404';
    //       $url = 'https://www.gravatar.com/avatar/';
    //       $url .= md5(strtolower(trim($this->email)));
    //       $url .= "?s=$s&d=$d";
    //
    //       if (!@fopen($url,'r')) {
    //         $url = '/images/avatars/default.jpg';
    //       }
    //     }
    //     return $url;
    // }

    public function isManager()
    {
        $request=false;
        if ((Auth::user()->role_id) == 2) {
            $request=true;
        };
        return $request;
    }
    public function isAdmin()
    {
        $request=false;
        if ((Auth::user()->role_id) == 3) {
            $request=true;
        };
        return $request;
    }

    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }


    //Admin

    public function scopeUsrAll($query)
    {
        return $query->where('deleted_at', null);
    }
    public function scopeUsrDel($query)
    {
        return $query->whereNotNull('deleted_at', null);
    }
    public function scopeUsrModer($query)
    {
        return $query->where('role_id', '=', 2)->where('deleted_at', null);
    }
    public function scopeUsrAdm($query)
    {
        return $query->where('role_id', '=', 3)->where('deleted_at', null);
    }
}
