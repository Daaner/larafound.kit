<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\StaticText;
use App\User;

class StaticTextAdd extends Model
{
  use SoftDeletes;

  // default table
  // protected $table = 'static_ru';

  public function StaticTru() {
    return $this->hasOne(StaticText, 'ru', 'id');
  }

  public function user() {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

}
