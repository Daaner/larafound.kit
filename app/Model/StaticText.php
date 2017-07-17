<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Support\Facades\Validator;

use App\Admin\Model\StaticTextAddRu;
use App\Admin\Model\StaticTextAddEn;
use App\User;

use App\Traits\DatesTraitTimestamp;
use App\Traits\DatesTraitPublished;
use App\Traits\AliasTrait;

class StaticText extends Model
{
    use SoftDeletes;
    use DatesTraitTimestamp;
    use DatesTraitPublished;
    use AliasTrait;


    protected $table = 'statictexts';

    protected $dates = ['publish_up', 'publish_down'];

    protected $fillable = [
        'name',
        'alias',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function StaticAddRu()
    {
        return $this->hasOne(StaticTextAddRu::class, 'id', 'ru');
    }

    public function StaticAddEn()
    {
        return $this->hasOne(StaticTextAddEn::class, 'id', 'en');
    }

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
}
