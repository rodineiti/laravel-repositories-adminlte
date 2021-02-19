<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionChoice extends Model
{
	protected $fillable = ['question_id', 'title', 'correct', 'order'];
	
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
