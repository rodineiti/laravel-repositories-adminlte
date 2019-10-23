<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'url', 'description'];
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Set the category slug url.
     *
     * @param  string  $value
     * @return void
     */
    public function setUrlAttribute($value)
    {
        $this->attributes['url'] = Str::slug($this->attributes['title'], '-');
    }
}
