<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Url>
 */
class UrlFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'original_url' => $this->faker->url,
            'short_url' => Str::random(6),
            'clicks' => 0,
        ];
    }
}
