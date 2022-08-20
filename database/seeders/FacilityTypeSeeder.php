<?php

namespace Database\Seeders;

use App\Models\FacilityType;
use Illuminate\Database\Seeder;

class FacilityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FacilityType::create([
            'name' => '2 Bed room Type A',
        ]);
        FacilityType::create([
            'name' => '2 Bed room Type B',
        ]);
        FacilityType::create([
            'name' => '3 Bed room Type A',
        ]);
        FacilityType::create([
            'name' => '3 Bed room Type B',
        ]);
        FacilityType::create([
            'name' => '4 Bed room Attached Villa',
        ]);
        FacilityType::create([
            'name' => '4 Bedroom Detached Villa Type-A',
        ]);
        FacilityType::create([
            'name' => '4 Bedroom Detached Villa Type-B',
        ]);
        FacilityType::create([
            'name' => '5 Bedroom Detached Villa',
        ]);
        FacilityType::create([
            'name' => 'Firefighting System',
        ]);
        FacilityType::create([
            'name' => 'Elevator',
        ]);
    }
}
