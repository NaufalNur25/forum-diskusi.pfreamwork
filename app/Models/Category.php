<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'category_id';

    protected $fillable = [
        'name',
    ];

    protected function postsCount(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) =>
            $attributes['posts_count'] ?? $this->posts()->count()
        );
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'category_id', 'category_id');
    }
}
