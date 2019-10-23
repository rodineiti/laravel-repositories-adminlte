<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'url', 'description', 'price'];

    /*
    *
    * Scope global anonimo
    */
    public static function boot()
    {
    	parent::boot();
    	static::addGlobalScope('orderByPrice', function(Builder $builder) {
    		$builder->orderBy('price', 'DESC');
    	});
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Set the product slug url.
     *
     * @param  string  $value
     * @return void
     */
    public function setUrlAttribute($value)
    {
        $this->attributes['url'] = Str::slug($this->attributes['name'], '-');
    }
}
