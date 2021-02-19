<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = [
    	'institution_id',
    	'teaching_unit_id',
    	'offer_type_id',
    	'discipline_id',
    	'state',
    	'city',
    	'year',
    	'jury',
    	'subject_id',
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function teaching_unit()
    {
        return $this->belongsTo(TeachingUnit::class);
    }

    public function offer_type()
    {
        return $this->belongsTo(OfferType::class);
    }

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
