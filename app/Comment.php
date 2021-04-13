<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'user_id',
        'blog_id',
        'parent_id'
    ];

    /**
     * Get the user associated to the comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the blog the comment belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    /**
     * Get the comment replies
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')
                    ->where('parent_id', '>', 0)
                    ->with('replies') // recursive up to deepest nested child
                    ->with('user')
                    ->latest();
    }

    /**
     * Get the comment replies
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id')
                    ->with('parent') // recursive up to root
                    ->latest();
    }
}
