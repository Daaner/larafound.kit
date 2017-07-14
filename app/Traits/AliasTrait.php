<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait AliasTrait
{
  public function setAliasAttribute($value) {
      if(empty($value)){
          $this->attributes['alias']=Str::slug($this->name);
      }
  }
}
