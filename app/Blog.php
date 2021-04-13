<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'body', 'author_id'];

    /**
     * Get comments associated to the blog
     *
     * @return void
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get author of the blog
     *
     * @return void
     */
    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }
}
