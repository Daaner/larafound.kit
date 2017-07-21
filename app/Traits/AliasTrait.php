<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait AliasTrait
{
    public function VerifyAlias($value)
    {
        if (empty($value)) {
          if ($this->title){
            $value = Str::slug($this->title);
          } elseif ($this->name){
            $value = Str::slug($this->name);
          } else {
            $value = 'alias_'. date("Y-d-m-H-i-s");
          }
        }

        return $this->attributes['alias'] = $value;
    }


    public function setAliasAttribute($value)
    {
        $this->VerifyAlias($value);
    }
}
