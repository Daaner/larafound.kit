<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\User;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\DatesTraitTimestamp;
use App\Traits\DatesTraitPublished;
use App\Traits\AliasTrait;

class NewsArticle extends Model
{
  use SoftDeletes;
  use DatesTraitTimestamp;
  use DatesTraitPublished;
  use AliasTrait;

  public function user()
  {
      return $this->belongsTo(User::class, 'user_id', 'id');
  }


}
