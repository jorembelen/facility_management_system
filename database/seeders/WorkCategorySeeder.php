<?php

namespace Database\Seeders;

use App\Models\WorkCategory;
use Illuminate\Database\Seeder;

class WorkCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WorkCategory::create([
            'name' => 'Appliance Technician',
        ]);
        WorkCategory::create([
            'name' => 'HVAC Technician',
        ]);
        WorkCategory::create([
            'name' => 'Electrical',
        ]);
        WorkCategory::create([
            'name' => 'Plumbing',
        ]);
        WorkCategory::create([
            'name' => 'Masonry',
        ]);
        WorkCategory::create([
            'name' => 'Carpentry',
        ]);
        // WorkCategory::create([
        //     'name' => 'For Garage',
        // ]);
        WorkCategory::create([
            'name' => 'Pest Control',
        ]);
        WorkCategory::create([
            'name' => 'Preventive Maintenance',
        ]);
        WorkCategory::create([
            'name' => 'Emergency',
        ]);
        WorkCategory::create([
            'name' => 'Restoration',
        ]);
    }
}
