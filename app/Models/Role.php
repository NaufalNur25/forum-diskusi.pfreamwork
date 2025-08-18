<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasUuids;

    protected $table = 'roles';
    protected $primaryKey = 'role_id';

    /**
     * Get the ID of the 'User' role.
     *
     * @return string|null
     */
    public static function getRoleForUser(): ?string
    {
        return static::where('name', 'User')->value('role_id');
    }

        public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id', 'role_id');
    }
}
