<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

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




}
