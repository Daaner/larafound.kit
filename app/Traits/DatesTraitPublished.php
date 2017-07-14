<?php

namespace App\Traits;

use Auth;
use Carbon\Carbon;

trait DatesTraitPublished
{
    public function getMutatedPublishedValue($value)
    {
        $timezone = config('app.timezone');

        if (Auth::check() && Auth::user()->timezone) {
            $timezone = Auth::user()->timezone;
        }
        return Carbon::parse($value)
            ->timezone($timezone);
    }

    public function getPublishUpAttribute($value)
    {
        return $this->getMutatedPublishedValue($value);
    }

    public function getPublishDownAttribute($value)
    {
        if ($value) {
            return $this->getMutatedPublishedValue($value);
        }
    }
}
