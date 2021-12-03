<?php

namespace TNM\Permissions\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use TNM\Permissions\Models\Role;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word
        ];
    }
}
