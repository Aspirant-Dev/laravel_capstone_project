<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'cate_id',
        'cate_name',
        'p_code',
        'name',
        'slug',
        'brand',
        'product_type',
        'description',
        'price',
        'stocks',
        'critical_level',
        'unit',
        'image',
        'status',
        'trending',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];
    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class,'cate_id','id');
    }
    public static function productsCount($category_id)
    {
        $productsCount = Product::where(['cate_id'=>$category_id, 'status'=>1])->count();
        return $productsCount;
    }
}
