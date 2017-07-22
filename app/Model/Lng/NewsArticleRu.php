<?php

namespace App\Model\Lng;

use Illuminate\Database\Eloquent\Model;

use App\Model\NewsArticle;
use App\Model\Lng\NewsCategoryRu;


class NewsArticleRu extends NewsArticle
{

  protected $table = 'news_articles_ru';

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

  public function ncatru()
  {
      return $this->belongsTo(NewsCategoryRu::class, 'category', 'id');
  }
}
