<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    protected $fillable = ["title", "slug", "body"];

    /**
     * Set the page slug.
     *
     * @param  string  $value
     * @return void
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($this->attributes['title'], '-');
    }

    public function subpages()
    {
        return $this->hasMany(SubPage::class);
    }
}
