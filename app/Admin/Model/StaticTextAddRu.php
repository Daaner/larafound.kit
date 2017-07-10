<?php

namespace App\Admin\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\StaticTextAdd;

class StaticTextAddRu extends StaticTextAdd
{
    protected $table = 'static_ru';


    public function scopeStaticActive($query){
       return $query->where('published', '=', 1)->where('deleted_at', null);
    }
    public function scopeStaticDraft($query){
       return $query->where('published', '=', 0)->where('deleted_at', null);
    }
    public function scopeStaticDel($query){
       return $query->where('deleted_at', '<>', null);
    }

}
