<?php

namespace TNM\Permissions\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public static function add(string $endpoint, string $method, string $name, string $group = null): self
    {
        return self::create(['endpoint' => $endpoint, 'method' => $method, 'name' => $name, 'group' => $group]);
    }
}
