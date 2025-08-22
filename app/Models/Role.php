<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Role extends Model
{
    use HasUuids;

    protected $table = 'roles';
    protected $primaryKey = 'role_id';

    public static function getRoleForUser(): ?string
    {
        return static::where('name', 'User')->value('role_id');
    }

    public static function getRoleForAdmin(): ?string
    {
        return static::where('name', 'Admin')->value('role_id');
    }

        public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id', 'role_id');
    }
}
