<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'comment_id';

    protected $fillable = [
        'user_id',
        'post_id',
        'content',
        'comment',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(User::class, 'post_id', 'post_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'comment_id', 'comment_id');
    }
}
