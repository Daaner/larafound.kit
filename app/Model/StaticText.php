<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Admin\Model\StaticTextAddRu;
use App\Admin\Model\StaticTextAddEn;
use App\User;


class StaticText extends Model
{

    use SoftDeletes;


    protected $table = 'statictexts';

    protected $fillable = [
        'name',
        'alias',
    ];


    public function user() {
      return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function StaticAddru() {
      return $this->hasOne(StaticTextAddRu::class, 'id', 'ru');
    }

    public function StaticAdden() {
      return $this->hasOne(StaticTextAddEn::class, 'id', 'en');
    }



}
