<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class Proverb extends Model
{
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'meaning', 'synonyms',
    ];
    
}
