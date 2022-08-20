<?php

namespace Database\Seeders;

use App\Models\ClientAppointment;
use Illuminate\Database\Seeder;

class ClientAppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClientAppointment::factory(200)->create();
    }
}
