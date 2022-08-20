<?php

namespace Database\Seeders;

use App\Models\Building;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(EmployeeSeeder::class);
        User::factory(10)->create();

        $this->call(WorkCategorySeeder::class);
        $this->call(FacilityTypeSeeder::class);
        $this->call(CategoryOptionsTableSeeder::class);
        $this->call(BuildingsTableSeeder::class);
        $this->call(ClientAppointmentSeeder::class);
        $this->call(MaintenanceLocationsTableSeeder::class);

    }
}
