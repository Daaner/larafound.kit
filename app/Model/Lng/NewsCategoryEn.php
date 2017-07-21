<?php

namespace App\Model\Lng;

use Illuminate\Database\Eloquent\Model;

use App\Model\NewsCategory;

class NewsCategoryEn extends NewsCategory
{
  protected $table = 'news_categories_en';

  public function scopeNewsCatActive($query)
  {
      return $query->where('published', '=', 1)->where('deleted_at', null);
  }
  public function scopeNewsCatDraft($query)
  {
      return $query->where('published', '=', 0)->where('deleted_at', null);
  }
  public function scopeNewsCatDel($query)
  {
      return $query->where('deleted_at', '<>', null);
  }
}
