<?php

namespace App\Models\Trivia;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userid', 'category', 'level', 'title', 'answer', 'option1', 'option2', 'option3', 'option4',
    ];

}
