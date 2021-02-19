<?php

namespace App\Observers;

use App\Models\Image;
use App\Traits\UploadTrait;

class ImageObserver
{
    use UploadTrait;

    protected $field = "path";
    protected $disk = "public_uploads";
    protected $path = "images/";

    public function creating(Image $model)
    {
        $this->sendFile($model);
    }

    public function updating(Image $model)
    {
        $this->updateFile($model);
    }

    public function deleting(Image $model)
    {
        $this->removeFile($model);
    }
}
