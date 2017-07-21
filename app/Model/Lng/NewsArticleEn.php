<?php

namespace App\Model\Lng;

use Illuminate\Database\Eloquent\Model;

use App\Model\NewsArticle;

class NewsArticleEn extends NewsArticle
{
  protected $table = 'news_articles_en';

  public function scopeNewsActive($query)
  {
      return $query->where('published', '=', 1)->where('deleted_at', null);
  }
  public function scopeNewsDraft($query)
  {
      return $query->where('published', '=', 0)->where('deleted_at', null);
  }
  public function scopeNewsDel($query)
  {
      return $query->where('deleted_at', '<>', null);
  }
}
