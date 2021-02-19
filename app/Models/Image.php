<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Support\Cropper;

class Image extends Model
{
    protected $fillable = ['name','path'];

    protected $appends = ['path_url'];

    public function getPathUrlAttribute($value)
    {
        if ($this->path) {
            return Storage::url(Cropper::thumb('images/' . $this->path, 200));
        }
        return null;
    }
}
