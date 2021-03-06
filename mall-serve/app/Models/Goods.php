<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goods extends Model
{
    use SoftDeletes;
    
    protected $dates = [
        'deleted_at'
    ];
    
    protected  $table = "goods_basic";
    
    
    protected $fillable= [
		'goods_name',
		'goods_price',
		'goods_number',
		'unit_type',
		'description',
		'cover_url',
		'status',
		'subtitle',
		'brief',
		'goods_sn',
        'sku_sn',
        'new_goods',
        'hot_goods',
        'del_price',
        'comments',
        'sale_count',
        'sale_able_count'
    ];
    
    //多对多
    public function category() 
    {
        //->withTimestamps()
        return $this->belongsToMany('App\Models\Category', 'goods_categories', 'goods_id', 'cate_id');
    }
    
    public function midCate(){
    	return $this->hasMany('App\Models\GoodsCategory');
    }
    
    //1对多
    public function imgs() 
    {
        return $this->hasMany('App\Models\GoodsImg', 'goods_id');
    }
    
    //1对多
    public function skus()
    {
    	return $this->hasMany('App\Models\Sku', 'goods_id');
    }
    
    //1对多
    public function attrs()
    {
    	return $this->belongsToMany('App\Models\GoodsSpecs', 'sku_attrs', 'goods_id', 'spec_id');
    }
    
    public function derectAttr()
    {
        return $this->hasMany("App\Models\SkuAttr", 'goods_id');
    }
    
    
    /**
     * 获取封面图片。
     *
     * @param  string  $value
     * @return string
     */
    public function getCoverUrlAttribute($value)
    {
        if($value){
            $value = asset($value);
        }
    	return $value;
    }
    
    public static function getCount()
    {
    	return self::withTrashed()->count();
    }
    
    /**
     * 限制查询只包括上架。
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
