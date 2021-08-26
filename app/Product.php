<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_product','name', 'thickness', 'width', 'length','type_measure','length_mm','PT','TOTAL_PT','m2','m3','pulg','m2_total','m3_total','pulg_total',
        'description',  'product_category_id', 'purchase_price', 'selling_price', 'stock', 'stock_defective'
    ];

    public function category()
    {
        return $this->belongsTo('App\ProductCategory', 'product_category_id')->withTrashed();
    }

    public function solds()
    {
        return $this->hasMany('App\SoldProduct');
    }

    public function receiveds()
    {
        return $this->hasMany('App\ReceivedProduct');
    }
}
