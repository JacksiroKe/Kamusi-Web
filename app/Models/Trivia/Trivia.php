<?php

namespace App\Models\Trivia;

use Illuminate\Database\Eloquent\Model;

class Trivia extends Model
{
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'playerid', 'category', 'level', 'questions', 'score'
    ];
    
}
