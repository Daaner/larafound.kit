<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;

use App\Traits\DatesTraitTimestamp;
use App\Traits\AliasTrait;

class NewsCategory extends Model
{

  use SoftDeletes;
  use DatesTraitTimestamp;
  use AliasTrait;

  public function user() {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }
  
}
