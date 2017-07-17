<?php

namespace App\Traits;

use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Validator;

trait AliasTrait
{
    public function VerifyAlias($value)
    {
        if (empty($value)) {
            $value = Str::slug($this->name);
        }

        return $this->attributes['alias'] = $value;
    }


    public function setAliasAttribute($value)
    {
        $this->VerifyAlias($value);
    }
}
