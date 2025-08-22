<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Post extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'post_id';

    protected $fillable = [
        'user_id',
        'category_id',
        'question',
        'content',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class, 'post_id', 'post_id');
    }

    public function interactions()
    {
        return $this->hasMany(Interaction::class, 'post_id', 'post_id');
    }

    public function likes()
    {
        return $this->interactions()->where('like', true);
    }

    public function dislikes()
    {
        return $this->interactions()->where('like', false);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id', 'post_id');
    }

    public function allReplies(): HasManyThrough
    {
        return $this->hasManyThrough(Answer::class, Comment::class, 'post_id', 'comment_id', 'post_id', 'comment_id');
    }
}
