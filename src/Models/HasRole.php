<?php

namespace TNM\Permissions\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasRole
{
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}