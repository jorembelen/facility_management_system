<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'badge' => $this->faker->numberBetween(1,1000000),
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password', // password
            'username' => substr(str_replace(' ','',strtolower($this->faker->name)), 0, 5).rand(1,3)
        ];
    }
}
