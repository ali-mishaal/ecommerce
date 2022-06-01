<?php

namespace Modules\CommonModule\Helper;

use Illuminate\Support\Facades\App;

class LanguageHelper
{
    /**
     * Retrieve all active lang from db.
     * active lang has [1] property.
     *
     * @return void
     */

    public static function statusTranslate($status)
    {
        if ($status)
            return (App::getLocale() == 'ar') ? $status->status_ar : $status->status;
        else
            return '';
    }

    public static function cityTranslate($city)
    {
        if ($city)
            return (App::getLocale() == 'ar') ? $city->governorate_name : $city->governorate_name_en;
        else
            return '';
    }

    public static function districtTranslate($district)
    {
        if ($district)
            return (App::getLocale() == 'ar') ? $district->name_ar : $district->name_en;
        else
            return '';
    }

}
