<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'category_id', 'user_id', 'image_url'];

    /**
     * Get the user that owns the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category of the post.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the users who have liked the post.
     */
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    /**
     * Get the comments associated with the post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
