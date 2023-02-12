<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$RE47cgkb57u2tZq1M0.z4.Le.e..E8yL6pMVLvOSVXXqHXMIwaB3i', // password
            'user_code' => fake()->text(12),
            'role' => fake()->word(),
            'referer_id' => fake()->numberBetween(1, 10),
            'phone' => fake()->unique()->numberBetween([1000, 9999]),
            'birthdate' => fake()->date(),
            'gender' => fake()->word(),
            'photo' => fake()->imageUrl(),
            'points' => 0,
            'total_points' => 0,
            'status' => fake()->word(),
            'last_visit' => fake()->dateTime(),
            'refer_code' => Str::random(5),
            'refering_count' => fake()->numberBetween(0, 20),
            'device_token' => Str::random(10),
            'checking_review_date' => fake()->dateTime(),
            'facebook_review_date' => fake()->dateTime(),
            'checkin_review_status' => fake()->word(),
            'google_review_status' => fake()->word(),
            'facebook_review_status' => fake()->word(),
            'google_status' => fake()->word(),
            'google_review_date' => fake()->dateTime(),
            'facebook_status' => fake()->word(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
