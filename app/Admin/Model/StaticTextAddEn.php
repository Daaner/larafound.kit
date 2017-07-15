<?php

namespace App\Admin\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\StaticText;
use App\Model\StaticTextAdd;
use App\Traits\DatesTraitTimestamp;

class StaticTextAddEn extends StaticTextAdd
{
    use DatesTraitTimestamp;

    protected $table = 'static_en';

    public function scopeStaticActive($query)
    {
        return $query->where('published', '=', 1)->where('deleted_at', null);
    }
    public function scopeStaticDraft($query)
    {
        return $query->where('published', '=', 0)->where('deleted_at', null);
    }
    public function scopeStaticDel($query)
    {
        return $query->where('deleted_at', '<>', null);
    }

    public function stexten()
    {
        return $this->hasMany(StaticTextAdd::class, 'en', 'id');
    }
}
