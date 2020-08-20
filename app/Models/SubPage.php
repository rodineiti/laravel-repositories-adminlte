<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubPage extends Model
{
    protected $fillable = ["page_id", "title", "slug", "body"];

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

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
