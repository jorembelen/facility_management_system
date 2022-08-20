<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class ClientAppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = DB::table('users')->whereNotIn('role', ['supervisor', 'admin', 'super_admin', 'assigner', 'representative', 'scheduler'])->get()->random()->badge;
        return [
            'user_id' => $user,
            'building_id' => DB::table('buildings')->get()->random()->id,
            'work_category_id' => $this->faker->numberBetween(1,7),
            'schedule_time' => $this->faker->randomElement(['9:20 - 11:20 AM', '11:20 - 1:20 PM', '3:30 - 4:20 PM']),
            'job_description' => $this->faker->text(100),
            'job_location' => $this->faker->text(20),
            'date' => $this->faker->dateTimeBetween('-180 days', '+150 days'),
            'survey_score' => $this->faker->numberBetween(1,5),
            'status' => 1,
            'survey_status' => 1,
        ];
    }
}
