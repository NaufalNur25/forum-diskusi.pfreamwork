<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids;

    protected $table = 'users';
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'is_blocked'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_blocked' => 'boolean',
        ];
    }

    public static array $statusTexts = [
        'banned' => 'Banned',
        'unverified' => 'Unverified',
        'safe' => 'Safe'
    ];

    protected function status(): Attribute
    {
        $status = self::$statusTexts['safe'];

        if (! $this->email_verified_at) {
            $status = self::$statusTexts['unverified'];
        }

        if ($this->is_blocked) {
            $status = self::$statusTexts['banned'];
        }

        return Attribute::make(
            get: fn($value, $attributes) =>
            $attributes['status'] ?? $status
        );
    }

    protected function postsCount(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) =>
            $attributes['posts_count'] ?? $this->posts()->count()
        );
    }

    /**
     * Get the role that owns the user.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    /**
     * Get the posts for the user.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'user_id', 'user_id');
    }

    /**
     * Get the answers for the user.
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class, 'user_id', 'user_id');
    }

    /**
     * Get the interactions for the user.
     */
    public function interactions(): HasMany
    {
        return $this->hasMany(Interaction::class, 'user_id', 'user_id');
    }

    /**
     * Get all of the user's comments.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'user_id', 'user_id');
    }

    protected static function hasEmail(string $email): bool | self
    {
        $user = self::where('email', $email)->first();

        return $user ?? (bool) $user;
    }

    public function hasRole($roleName)
    {
        return $this->role && Str::lower($this->role->name) === Str::lower($roleName);
    }

    public function hasRoleId($roleId)
    {
        return $this->role_id === $roleId;
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function isUser()
    {
        return $this->hasRole('user');
    }
}
