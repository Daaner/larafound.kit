<?php

namespace App\Model\Lng;

use Illuminate\Database\Eloquent\Model;

use App\Model\NewsCategory;
use App\Model\Lng\NewsArticleRu;

class NewsCategoryRu extends NewsCategory
{

  protected $table = 'news_categories_ru';

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

  public function ntextru()
  {
      return $this->hasMany(NewsArticleRu::class);
  }

}
