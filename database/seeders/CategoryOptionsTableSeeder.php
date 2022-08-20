<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoryOptionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('category_options')->delete();
        
        \DB::table('category_options')->insert(array (
            0 => 
            array (
                'id' => 1,
                'work_category_id' => 2,
                'name' => 'Check/repair AC not cooling',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            1 => 
            array (
                'id' => 2,
                'work_category_id' => 2,
                'name' => 'Check/repair AC not working',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            2 => 
            array (
                'id' => 3,
                'work_category_id' => 2,
                'name' => 'Check/repair AC water leak',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            3 => 
            array (
                'id' => 4,
                'work_category_id' => 2,
                'name' => 'Check/repair AC abnormal sound',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            4 => 
            array (
                'id' => 5,
                'work_category_id' => 2,
                'name' => 'Check/repair AC breaker trip',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            5 => 
            array (
                'id' => 6,
                'work_category_id' => 2,
                'name' => 'Check/repair AC remote not working',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            6 => 
            array (
                'id' => 7,
                'work_category_id' => 2,
                'name' => 'Check/repair damage AC parts',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            7 => 
            array (
                'id' => 8,
                'work_category_id' => 2,
                'name' => 'Check/repair error AC display',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            8 => 
            array (
                'id' => 9,
                'work_category_id' => 3,
                'name' => 'Replace busted lights',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            9 => 
            array (
                'id' => 10,
                'work_category_id' => 3,
                'name' => 'Check/repair lighting switch not working',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            10 => 
            array (
                'id' => 11,
                'work_category_id' => 3,
                'name' => 'Check/repair power outlet not working',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            11 => 
            array (
                'id' => 12,
                'work_category_id' => 3,
                'name' => 'Check/repair exhaust fan not working',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            12 => 
            array (
                'id' => 13,
                'work_category_id' => 3,
                'name' => 'Check/repair exhaust fan abnormal sound',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            13 => 
            array (
                'id' => 14,
                'work_category_id' => 3,
                'name' => 'Check/repair fire detector beeping',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            14 => 
            array (
                'id' => 15,
                'work_category_id' => 3,
                'name' => 'Inspect/deactivate fire alarm ringing',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            15 => 
            array (
                'id' => 16,
                'work_category_id' => 3,
                'name' => 'Check/repair power shutdown',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            16 => 
            array (
                'id' => 17,
                'work_category_id' => 3,
                'name' => 'Check/repair intercom not working',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            17 => 
            array (
                'id' => 18,
                'work_category_id' => 3,
                'name' => 'Check/repair photocell not working',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            18 => 
            array (
                'id' => 19,
                'work_category_id' => 3,
                'name' => 'Check/repair water heater not heating',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            19 => 
            array (
                'id' => 20,
                'work_category_id' => 3,
                'name' => 'Check/repair electric shock source',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            20 => 
            array (
                'id' => 21,
                'work_category_id' => 1,
                'name' => 'Check/repair washer not working',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            21 => 
            array (
                'id' => 22,
                'work_category_id' => 1,
                'name' => 'Check/repair dryer not working',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            22 => 
            array (
                'id' => 23,
                'work_category_id' => 1,
                'name' => 'Check/repair oven not working',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            23 => 
            array (
                'id' => 24,
                'work_category_id' => 1,
                'name' => 'Check/repair refrigerator not working',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            24 => 
            array (
                'id' => 25,
                'work_category_id' => 6,
                'name' => 'Check/repair cabinet formica broken',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            25 => 
            array (
                'id' => 26,
                'work_category_id' => 6,
                'name' => 'Check/repair damage cabinet hinges',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            26 => 
            array (
                'id' => 27,
                'work_category_id' => 6,
                'name' => 'Check/repair damage cabinet handle',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            27 => 
            array (
                'id' => 28,
                'work_category_id' => 6,
                'name' => 'Check/repair door lock not working',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            28 => 
            array (
                'id' => 29,
                'work_category_id' => 6,
                'name' => 'Check/repair damage door hinges',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            29 => 
            array (
                'id' => 30,
                'work_category_id' => 6,
                'name' => 'Check/repair damage door panel/frame',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            30 => 
            array (
                'id' => 31,
                'work_category_id' => 6,
                'name' => 'Check/repair door closer not working',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            31 => 
            array (
                'id' => 32,
                'work_category_id' => 6,
                'name' => 'Check/repair damage door stopper',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            32 => 
            array (
                'id' => 33,
                'work_category_id' => 6,
                'name' => 'Check/replace broken window glass',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            33 => 
            array (
                'id' => 34,
                'work_category_id' => 6,
                'name' => 'Check/repair damage window lock',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            34 => 
            array (
                'id' => 35,
                'work_category_id' => 6,
                'name' => 'Check/repair damage window handle',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            35 => 
            array (
                'id' => 36,
                'work_category_id' => 6,
                'name' => 'Check/replace damage window fly screen',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            36 => 
            array (
                'id' => 37,
                'work_category_id' => 6,
                'name' => 'Check/repair damage gypsum/aluminum ceiling',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            37 => 
            array (
                'id' => 38,
                'work_category_id' => 6,
                'name' => 'Check/repair fixing damage silicon',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            38 => 
            array (
                'id' => 39,
                'work_category_id' => 6,
                'name' => 'Check/repair damage countertop',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            39 => 
            array (
                'id' => 40,
                'work_category_id' => 6,
                'name' => 'Lock-out service',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            40 => 
            array (
                'id' => 41,
                'work_category_id' => 5,
                'name' => 'Check/repair/filling concrete gaps',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            41 => 
            array (
                'id' => 42,
                'work_category_id' => 5,
                'name' => 'Check/repair damage tile grout',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            42 => 
            array (
                'id' => 43,
                'work_category_id' => 5,
                'name' => 'Check/repair broken/crack tiles/marble',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            43 => 
            array (
                'id' => 44,
                'work_category_id' => 5,
                'name' => 'Check/repair damage water proofing',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            44 => 
            array (
                'id' => 45,
                'work_category_id' => 4,
                'name' => 'Check/repair plumbing line water leak',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            45 => 
            array (
                'id' => 46,
                'work_category_id' => 4,
                'name' => 'Check/repair damage/water leak valve',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            46 => 
            array (
                'id' => 47,
                'work_category_id' => 4,
                'name' => 'Check/repair damage/water leak faucet',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            47 => 
            array (
                'id' => 48,
                'work_category_id' => 4,
                'name' => 'Check/repair damage/water leak shattaf/bidet',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            48 => 
            array (
                'id' => 49,
                'work_category_id' => 4,
                'name' => 'Check/repair drain clog',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            49 => 
            array (
                'id' => 50,
                'work_category_id' => 4,
                'name' => 'Check/repair drain water leak',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            50 => 
            array (
                'id' => 51,
                'work_category_id' => 4,
                'name' => 'Check/repair damage/leakage wc',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            51 => 
            array (
                'id' => 52,
                'work_category_id' => 4,
                'name' => 'Check/repair damage bathub',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
            52 => 
            array (
                'id' => 53,
                'work_category_id' => 4,
                'name' => 'Check/repair damage/leakage water heater',
                'created_at' => '2021-10-31 14:50:27',
                'updated_at' => '2021-10-31 14:50:27',
            ),
        ));
        
        
    }
}