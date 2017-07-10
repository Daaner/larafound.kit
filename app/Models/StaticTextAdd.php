<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\StaticText;

class StaticTextAdd extends Model
{
  use SoftDeletes;

  // default table
  protected $table = 'static_ru';

  public function scopeStaticRU($query){
    return (function () {
      return DB::table('static_ru')->where('deleted_at', null)->get();
    });
  }

  public function scopeStaticEN($query){
    return (function () {
      return DB::table('static_en')->where('deleted_at', null)->get();
    });
  }

}
