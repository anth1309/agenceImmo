<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @mixin IdeHelperPost
 */
class Post extends Model
{
    use HasFactory;
    //champs remplissable
    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id',
        'tag',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function imageUrl(): string
    {
        return Storage::url($this->image);
    }
}
    //protected $guarded = []; champs non remplissable
