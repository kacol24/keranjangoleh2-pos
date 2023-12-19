<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'is_active',
        'brand_id',
        'name',
        'sku_code',
        'short_description',
        'description',
        'price',
        'attributes',
    ];

    protected $casts = [
        'attributes' => 'array',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
