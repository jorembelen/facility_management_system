<?php

namespace Database\Factories;

use App\Models\Building;
use Illuminate\Database\Eloquent\Factories\Factory;

class BuildingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Building::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rc_no' => $this->faker->numberBetween(100, 900),
            'ifc_no' => $this->faker->numberBetween(1, 9),
            'flat_no' => $this->faker->numberBetween(1, 9),
            'block_no' => $this->faker->numberBetween(1, 50),
            'street' => $this->faker->text(10),
            'facility_type_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
