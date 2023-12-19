<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Brand extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'notes',
    ];

    public function getWhatsappPhoneAttribute()
    {
        $preparedPhone = str_replace(
            [
                ' ',
            ],
            [
                '',
            ],
            Str::of($this->phone)->replaceStart('62', '')
        );

        return '62'.$preparedPhone;
    }
}
