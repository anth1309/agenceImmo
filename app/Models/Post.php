<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    //champs remplissable
    protected $fillable = [
        'title',
        'content',
        'slug',
    ];

    //protected $guarded = []; champs non remplissable
}
