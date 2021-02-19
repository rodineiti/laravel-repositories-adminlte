<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferType extends Model
{
    protected $fillable = ['name'];

    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
