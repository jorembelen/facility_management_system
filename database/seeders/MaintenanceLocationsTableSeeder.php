<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MaintenanceLocationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('maintenance_locations')->delete();

        \DB::table('maintenance_locations')->insert(array (
            0 =>
            array (
                'id' => 1,
                'work_category_id' => 1,
                'location' => 'Kitchen',
                'arabic' => 'المطبخ',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            1 =>
            array (
                'id' => 2,
                'work_category_id' => 1,
                'location' => 'Laundry',
                'arabic' => 'منطقة الغسيل',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            2 =>
            array (
                'id' => 3,
                'work_category_id' => 2,
                'location' => 'Driver Room',
                'arabic' => 'غرفه السائق',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            3 =>
            array (
                'id' => 4,
                'work_category_id' => 2,
                'location' => 'Men\'s Sitting',
                'arabic' => 'مجلس الرجال',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            4 =>
            array (
                'id' => 5,
                'work_category_id' => 2,
                'location' => 'Dining Room',
                'arabic' => 'غرفة الطعام',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            5 =>
            array (
                'id' => 6,
                'work_category_id' => 2,
                'location' => 'Living Room',
                'arabic' => 'غرفة المعيشة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            6 =>
            array (
                'id' => 7,
                'work_category_id' => 2,
                'location' => 'Nook Area',
                'arabic' => 'منطقة الزاوية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            7 =>
            array (
                'id' => 8,
                'work_category_id' => 2,
                'location' => 'Kitchen',
                'arabic' => 'المطبخ',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            8 =>
            array (
                'id' => 9,
                'work_category_id' => 2,
                'location' => 'Ladies Sitting',
                'arabic' => 'مجلس النساء',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            9 =>
            array (
                'id' => 10,
                'work_category_id' => 2,
                'location' => 'Maid\'s Room',
                'arabic' => 'غرفة الخادمة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            10 =>
            array (
                'id' => 11,
                'work_category_id' => 2,
                'location' => 'Corridor',
                'arabic' => 'الممرات',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            11 =>
            array (
                'id' => 12,
                'work_category_id' => 2,
                'location' => 'Kid\'s Bedroom-1',
                'arabic' => 'غرفة الأطفال 1',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            12 =>
            array (
                'id' => 13,
                'work_category_id' => 2,
                'location' => 'Kid\'s Bedroom-2',
                'arabic' => 'غرفة الأطفال 2',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            13 =>
            array (
                'id' => 14,
                'work_category_id' => 2,
                'location' => 'Master Bedroom',
                'arabic' => 'غرفة النوم الرئيسية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            14 =>
            array (
                'id' => 15,
                'work_category_id' => 2,
                'location' => 'Master Dresser',
                'arabic' => 'المنطقة الخاصة بالملابس داخل غرفة النوم الرئيسية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            15 =>
            array (
                'id' => 16,
                'work_category_id' => 2,
                'location' => 'Private sitting',
                'arabic' => 'المنطقة الخاصة بالجلوس داخل غرفة النوم الرئيسية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            16 =>
            array (
                'id' => 17,
                'work_category_id' => 2,
                'location' => 'Semi-master bedroom',
                'arabic' => 'غرفة النوم الثانوية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            17 =>
            array (
                'id' => 18,
                'work_category_id' => 2,
                'location' => 'Storage Room',
                'arabic' => 'غرفة التخزين',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            18 =>
            array (
                'id' => 19,
                'work_category_id' => 2,
                'location' => 'Electrical Room',
                'arabic' => 'غرفة الكهرباء',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            19 =>
            array (
                'id' => 20,
                'work_category_id' => 2,
                'location' => 'Telecom Room',
                'arabic' => 'غرفة الاتصالات',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            20 =>
            array (
                'id' => 21,
                'work_category_id' => 3,
                'location' => 'Driver Room',
                'arabic' => 'غرفه السائق',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            21 =>
            array (
                'id' => 22,
                'work_category_id' => 3,
                'location' => 'Garage Area',
                'arabic' => 'منطقة الكراج',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            22 =>
            array (
                'id' => 23,
                'work_category_id' => 3,
                'location' => 'Yard Area',
                'arabic' => 'منطقة الفناء',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            23 =>
            array (
                'id' => 24,
                'work_category_id' => 3,
                'location' => 'Foyer',
                'arabic' => 'مدخل الباب الرئيسي',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            24 =>
            array (
                'id' => 25,
                'work_category_id' => 3,
                'location' => 'Men\'s Wash',
                'arabic' => 'مغسلة الرجال',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            25 =>
            array (
                'id' => 26,
                'work_category_id' => 3,
                'location' => 'Men\'s Toilet',
                'arabic' => 'حمام الرجال',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            26 =>
            array (
                'id' => 27,
                'work_category_id' => 3,
                'location' => 'Men\'s Sitting',
                'arabic' => 'مجلس الرجال',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            27 =>
            array (
                'id' => 28,
                'work_category_id' => 3,
                'location' => 'Dining Room',
                'arabic' => 'غرفة الطعام',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            28 =>
            array (
                'id' => 29,
                'work_category_id' => 3,
                'location' => 'Living Room',
                'arabic' => 'غرفة المعيشة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            29 =>
            array (
                'id' => 30,
                'work_category_id' => 3,
                'location' => 'Nook Area',
                'arabic' => 'منطقة الزاوية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            30 =>
            array (
                'id' => 31,
                'work_category_id' => 3,
                'location' => 'Kitchen',
                'arabic' => 'المطبخ',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            31 =>
            array (
                'id' => 32,
                'work_category_id' => 3,
                'location' => 'Storage',
                'arabic' => 'منطقة التخزين',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            32 =>
            array (
                'id' => 33,
                'work_category_id' => 3,
                'location' => 'Ladies Sitting',
                'arabic' => 'مجلس النساء',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            33 =>
            array (
                'id' => 34,
                'work_category_id' => 3,
                'location' => 'Ladies Wash',
                'arabic' => 'منطقة مغسلة النساء',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            34 =>
            array (
                'id' => 35,
                'work_category_id' => 3,
                'location' => 'Ladies Toilet',
                'arabic' => 'حمام النساء',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            35 =>
            array (
                'id' => 36,
                'work_category_id' => 3,
                'location' => 'Stairs',
                'arabic' => 'السلالم',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            36 =>
            array (
                'id' => 37,
                'work_category_id' => 3,
                'location' => 'Maid\'s Room',
                'arabic' => 'غرفة الخادمة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            37 =>
            array (
                'id' => 38,
                'work_category_id' => 3,
                'location' => 'Maid\'s Toilet',
                'arabic' => 'حمام غرفة الخادمة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            38 =>
            array (
                'id' => 39,
                'work_category_id' => 3,
                'location' => 'Corridor',
                'arabic' => 'الممرات',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            39 =>
            array (
                'id' => 40,
                'work_category_id' => 3,
                'location' => 'Kid\'s Bedroom-1',
                'arabic' => 'غرفة الأطفال 1',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            40 =>
            array (
                'id' => 41,
                'work_category_id' => 3,
                'location' => 'Kid\'s Bedroom-2',
                'arabic' => 'غرفة الأطفال 2',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            41 =>
            array (
                'id' => 42,
                'work_category_id' => 3,
                'location' => 'Laundry Area',
                'arabic' => 'منطقة الغسيل',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            42 =>
            array (
                'id' => 43,
                'work_category_id' => 3,
                'location' => 'Common Wash',
                'arabic' => 'المغسلة المشتركة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            43 =>
            array (
                'id' => 44,
                'work_category_id' => 3,
                'location' => 'Common Toilet',
                'arabic' => 'الحمام المشترك',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            44 =>
            array (
                'id' => 45,
                'work_category_id' => 3,
                'location' => 'Master Bedroom',
                'arabic' => 'غرفة النوم الرئيسية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            45 =>
            array (
                'id' => 46,
                'work_category_id' => 3,
                'location' => 'Master Dresser',
                'arabic' => 'المنطقة الخاصة بالملابس داخل غرفة النوم الرئيسية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            46 =>
            array (
                'id' => 47,
                'work_category_id' => 3,
                'location' => 'Master Wash',
                'arabic' => 'منطقة مغسلة غرفة النوم الرئيسية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            47 =>
            array (
                'id' => 48,
                'work_category_id' => 3,
                'location' => 'Master Toilet',
                'arabic' => 'حمام غرفة النوم الرئيسية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            48 =>
            array (
                'id' => 49,
                'work_category_id' => 3,
                'location' => 'Private sitting',
                'arabic' => 'المنطقة الخاصة بالجلوس داخل غرفة النوم الرئيسية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            49 =>
            array (
                'id' => 50,
                'work_category_id' => 3,
                'location' => 'Semi-Master Bedroom',
                'arabic' => 'غرفة النوم الثانوية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            50 =>
            array (
                'id' => 51,
                'work_category_id' => 3,
                'location' => 'Semi-Master Closet',
                'arabic' => 'خزانة غرفة النوم الثانوية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            51 =>
            array (
                'id' => 52,
                'work_category_id' => 3,
                'location' => 'Semi-Master Toilet',
                'arabic' => 'حمام غرفة الخادمة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            52 =>
            array (
                'id' => 53,
                'work_category_id' => 3,
                'location' => 'Roof',
                'arabic' => 'السطح',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            53 =>
            array (
                'id' => 54,
                'work_category_id' => 3,
                'location' => 'Roof',
                'arabic' => 'السطح',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            54 =>
            array (
                'id' => 55,
                'work_category_id' => 3,
                'location' => 'Electrical Room',
                'arabic' => 'غرفة الكهرباء',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            55 =>
            array (
                'id' => 56,
                'work_category_id' => 3,
                'location' => 'Telecom Room',
                'arabic' => 'غرفة الاتصالات',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            56 =>
            array (
                'id' => 57,
                'work_category_id' => 4,
                'location' => 'Men\'s Wash',
                'arabic' => 'مغسلة الرجال',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            57 =>
            array (
                'id' => 58,
                'work_category_id' => 4,
                'location' => 'Men\'s Toilet',
                'arabic' => 'حمام الرجال',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            58 =>
            array (
                'id' => 59,
                'work_category_id' => 4,
                'location' => 'Kitchen',
                'arabic' => 'المطبخ',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            59 =>
            array (
                'id' => 60,
                'work_category_id' => 4,
                'location' => 'Maid\'s Toilet',
                'arabic' => 'حمام غرفة الخادمة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            60 =>
            array (
                'id' => 61,
                'work_category_id' => 4,
                'location' => 'Laundry',
                'arabic' => 'منطقة الغسيل',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            61 =>
            array (
                'id' => 62,
                'work_category_id' => 4,
                'location' => 'Common Wash',
                'arabic' => 'المغسلة المشتركة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            62 =>
            array (
                'id' => 63,
                'work_category_id' => 4,
                'location' => 'Common Toilet',
                'arabic' => 'الحمام المشترك',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            63 =>
            array (
                'id' => 64,
                'work_category_id' => 4,
                'location' => 'Master Wash',
                'arabic' => 'منطقة مغسلة غرفة النوم الرئيسية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            64 =>
            array (
                'id' => 65,
                'work_category_id' => 4,
                'location' => 'Masters Toilet',
                'arabic' => 'حمام غرفه النوم الرئيسية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            65 =>
            array (
                'id' => 66,
                'work_category_id' => 4,
                'location' => 'Semi-Master Toilet',
                'arabic' => 'حمام غرفة الخادمة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            66 =>
            array (
                'id' => 67,
                'work_category_id' => 5,
                'location' => 'Yard Area',
                'arabic' => 'منطقة الفناء',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            67 =>
            array (
                'id' => 68,
                'work_category_id' => 5,
                'location' => 'Garage Area',
                'arabic' => 'منطقة الكراج',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            68 =>
            array (
                'id' => 69,
                'work_category_id' => 5,
                'location' => 'Driver\'s Entry',
                'arabic' => 'مدخل غرفة السائق',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            69 =>
            array (
                'id' => 70,
                'work_category_id' => 5,
                'location' => 'Driver\'s Room',
                'arabic' => 'غرفة السائق',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            70 =>
            array (
                'id' => 71,
                'work_category_id' => 5,
                'location' => 'Driver\'s Toilet',
                'arabic' => 'حمام غرفة السائق',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            71 =>
            array (
                'id' => 72,
                'work_category_id' => 5,
                'location' => 'Men\'s Entrance Porch',
                'arabic' => 'منطقة ماقبل مدخل الباب الرئيسي',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            72 =>
            array (
                'id' => 73,
                'work_category_id' => 5,
                'location' => 'Men\'s Foyer',
                'arabic' => 'مدخل الباب الرئيسي',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            73 =>
            array (
                'id' => 74,
                'work_category_id' => 5,
                'location' => 'Men\'s Sitting Room',
                'arabic' => 'مجلس الرجال',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            74 =>
            array (
                'id' => 75,
                'work_category_id' => 5,
                'location' => 'Men\'s Wash Area',
                'arabic' => 'منطقة مغسلة الرجال',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            75 =>
            array (
                'id' => 76,
                'work_category_id' => 5,
                'location' => 'Men\'s Toilet',
                'arabic' => 'حمام الرجال',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            76 =>
            array (
                'id' => 77,
                'work_category_id' => 5,
                'location' => 'Dining Room',
                'arabic' => 'غرفة الطعام',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            77 =>
            array (
                'id' => 78,
                'work_category_id' => 5,
                'location' => 'Living Area',
                'arabic' => 'غرفة المعيشة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            78 =>
            array (
                'id' => 79,
                'work_category_id' => 5,
                'location' => 'Ladies Entrance',
                'arabic' => 'مدخل النساء',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            79 =>
            array (
                'id' => 80,
                'work_category_id' => 5,
                'location' => 'Corridor',
                'arabic' => 'الممرات',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            80 =>
            array (
                'id' => 81,
                'work_category_id' => 5,
                'location' => 'Ladies Sitting Room',
                'arabic' => 'مجلس النساء',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            81 =>
            array (
                'id' => 82,
                'work_category_id' => 5,
                'location' => 'Ladies Wash Area',
                'arabic' => 'منطقة مغسلة النساء',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            82 =>
            array (
                'id' => 83,
                'work_category_id' => 5,
                'location' => 'Ladies Toilet',
                'arabic' => 'حمام النساء',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            83 =>
            array (
                'id' => 84,
                'work_category_id' => 5,
                'location' => 'Kitchen',
                'arabic' => 'المطبخ',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            84 =>
            array (
                'id' => 85,
                'work_category_id' => 5,
                'location' => 'Pantry',
                'arabic' => 'مخزن المطبخ',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            85 =>
            array (
                'id' => 86,
                'work_category_id' => 5,
                'location' => 'Stair Hall',
                'arabic' => 'منطقة الصالة في الدور الاول',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            86 =>
            array (
                'id' => 87,
                'work_category_id' => 5,
                'location' => 'Master Closet',
                'arabic' => 'خزانه غرفة النوم الرئيسية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            87 =>
            array (
                'id' => 88,
                'work_category_id' => 5,
                'location' => 'Master bedroom',
                'arabic' => 'غرفة النوم الرئيسية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            88 =>
            array (
                'id' => 89,
                'work_category_id' => 5,
                'location' => 'Master Toilet',
                'arabic' => 'حمام غرفة النوم الرئيسية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            89 =>
            array (
                'id' => 90,
                'work_category_id' => 5,
                'location' => 'Ante-Room',
                'arabic' => 'مدخل غرفة النوم الرئيسيه أوالفرعية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            90 =>
            array (
                'id' => 91,
                'work_category_id' => 5,
                'location' => 'Kids Bedroom-1',
                'arabic' => 'غرفة الأطفال 1',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            91 =>
            array (
                'id' => 92,
                'work_category_id' => 5,
                'location' => 'Kids Bedroom-2',
                'arabic' => 'غرفة الأطفال 2',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            92 =>
            array (
                'id' => 93,
                'work_category_id' => 5,
                'location' => 'Common Toilet',
                'arabic' => 'الحمام المشترك',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            93 =>
            array (
                'id' => 94,
                'work_category_id' => 5,
                'location' => 'Common Wash',
                'arabic' => 'المغسلة المشتركة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            94 =>
            array (
                'id' => 95,
                'work_category_id' => 5,
                'location' => 'Semi-Master Bedroom',
                'arabic' => 'غرفة النوم الثانوية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            95 =>
            array (
                'id' => 96,
                'work_category_id' => 5,
                'location' => 'Semi-Master Closet',
                'arabic' => 'خزانة غرفة النوم الثانوية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            96 =>
            array (
                'id' => 97,
                'work_category_id' => 5,
                'location' => 'Semi-Master Toilet',
                'arabic' => 'حمام غرفة الخادمة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            97 =>
            array (
                'id' => 98,
                'work_category_id' => 5,
                'location' => 'Maid\'s Stair Hall',
                'arabic' => 'المنطقة أمام غرفة الخادمة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            98 =>
            array (
                'id' => 99,
                'work_category_id' => 5,
                'location' => 'Maid\'s Room',
                'arabic' => 'غرفة الخادمة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            99 =>
            array (
                'id' => 100,
                'work_category_id' => 5,
                'location' => 'Maid\'s Toilet',
                'arabic' => 'حمام غرفة الخادمة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            100 =>
            array (
                'id' => 101,
                'work_category_id' => 5,
                'location' => 'Laundry Room',
                'arabic' => 'منطقة الغسيل',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            101 =>
            array (
                'id' => 102,
                'work_category_id' => 5,
                'location' => 'Roof',
                'arabic' => 'السطح',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            102 =>
            array (
                'id' => 103,
                'work_category_id' => 5,
                'location' => 'Storage Room',
                'arabic' => 'غرفة التخزين',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            103 =>
            array (
                'id' => 104,
                'work_category_id' => 5,
                'location' => 'Electrical Room',
                'arabic' => 'غرفة الكهرباء',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            104 =>
            array (
                'id' => 105,
                'work_category_id' => 5,
                'location' => 'Telecom Room',
                'arabic' => 'غرفة الاتصالات',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            105 =>
            array (
                'id' => 106,
                'work_category_id' => 6,
                'location' => 'Garage Area',
                'arabic' => 'منطقة الكراج',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            106 =>
            array (
                'id' => 107,
                'work_category_id' => 6,
                'location' => 'Driver\'s Entry',
                'arabic' => 'مدخل غرفة السائق',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            107 =>
            array (
                'id' => 108,
                'work_category_id' => 6,
                'location' => 'Driver\'s Room',
                'arabic' => 'غرفة السائق',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            108 =>
            array (
                'id' => 109,
                'work_category_id' => 6,
                'location' => 'Driver\'s Toilet',
                'arabic' => 'حمام غرفة السائق',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            109 =>
            array (
                'id' => 110,
                'work_category_id' => 6,
                'location' => 'Men\'s Entrance',
                'arabic' => 'مدخل الرجال',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            110 =>
            array (
                'id' => 111,
                'work_category_id' => 6,
                'location' => 'Men\'s Sitting',
                'arabic' => 'مجلس الرجال',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            111 =>
            array (
                'id' => 112,
                'work_category_id' => 6,
                'location' => 'Men\'s Wash Area',
                'arabic' => 'منطقة مغسلة الرجال',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            112 =>
            array (
                'id' => 113,
                'work_category_id' => 6,
                'location' => 'Men\'s Toilet',
                'arabic' => 'حمام الرجال',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            113 =>
            array (
                'id' => 114,
                'work_category_id' => 6,
                'location' => 'Dining Room',
                'arabic' => 'غرفة الطعام',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            114 =>
            array (
                'id' => 115,
                'work_category_id' => 6,
                'location' => 'Living Area',
                'arabic' => 'غرفة المعيشة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            115 =>
            array (
                'id' => 116,
                'work_category_id' => 6,
                'location' => 'Kitchen Area',
                'arabic' => 'منطقة المطبخ',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            116 =>
            array (
                'id' => 117,
                'work_category_id' => 6,
                'location' => 'Storage Area',
                'arabic' => 'منطقة التخزين',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            117 =>
            array (
                'id' => 118,
                'work_category_id' => 6,
                'location' => 'Nook',
                'arabic' => 'المنطقة بالصالة المتصلة بالمطبخ',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            118 =>
            array (
                'id' => 119,
                'work_category_id' => 6,
                'location' => 'Ladies Entrance',
                'arabic' => 'مدخل النساء',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            119 =>
            array (
                'id' => 120,
                'work_category_id' => 6,
                'location' => 'Ladies Foyer',
                'arabic' => 'المنطقة أمام مدخل النساء',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            120 =>
            array (
                'id' => 121,
                'work_category_id' => 6,
                'location' => 'Ladies Sitting',
                'arabic' => 'مجلس النساء',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            121 =>
            array (
                'id' => 122,
                'work_category_id' => 6,
                'location' => 'Ladies Wash',
                'arabic' => 'منطقة مغسلة النساء',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            122 =>
            array (
                'id' => 123,
                'work_category_id' => 6,
                'location' => 'Ladies Toilet',
                'arabic' => 'حمام النساء',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            123 =>
            array (
                'id' => 124,
                'work_category_id' => 6,
                'location' => 'Stairs',
                'arabic' => 'السلالم',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            124 =>
            array (
                'id' => 125,
                'work_category_id' => 6,
                'location' => 'Private Sitting',
                'arabic' => 'المنطقة الخاصة بالجلوس داخل غرفة النوم الرئيسية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            125 =>
            array (
                'id' => 126,
                'work_category_id' => 6,
                'location' => 'Master\'s Bedroom',
                'arabic' => 'غرفة النوم الرئيسية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            126 =>
            array (
                'id' => 127,
                'work_category_id' => 6,
                'location' => 'Master Toilet',
                'arabic' => 'حمام غرفة النوم الرئيسية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            127 =>
            array (
                'id' => 128,
                'work_category_id' => 6,
                'location' => 'Semi-Master Bedroom',
                'arabic' => 'غرفة النوم الثانوية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            128 =>
            array (
                'id' => 129,
                'work_category_id' => 6,
                'location' => 'Semi-Master Closet',
                'arabic' => 'خزانة غرفة النوم الثانوية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            129 =>
            array (
                'id' => 130,
                'work_category_id' => 6,
                'location' => 'Semi-Master Toilet',
                'arabic' => 'حمام غرفة الخادمة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            130 =>
            array (
                'id' => 131,
                'work_category_id' => 6,
                'location' => 'Living Room',
                'arabic' => 'غرفة المعيشة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            131 =>
            array (
                'id' => 132,
                'work_category_id' => 6,
                'location' => 'Kids Bedroom-1',
                'arabic' => 'غرفة الأطفال 1',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            132 =>
            array (
                'id' => 133,
                'work_category_id' => 6,
                'location' => 'Common Toilet',
                'arabic' => 'الحمام المشترك',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            133 =>
            array (
                'id' => 134,
                'work_category_id' => 6,
                'location' => 'Kids Bedroom-2',
                'arabic' => 'غرفة الأطفال 2',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            134 =>
            array (
                'id' => 135,
                'work_category_id' => 6,
                'location' => 'Maid\'s Stair Hall',
                'arabic' => 'المنطقة أمام غرفة الخادمة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            135 =>
            array (
                'id' => 136,
                'work_category_id' => 6,
                'location' => 'Maid\'s Room',
                'arabic' => 'غرفة الخادمة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            136 =>
            array (
                'id' => 137,
                'work_category_id' => 6,
                'location' => 'Maid\'s Toilet',
                'arabic' => 'حمام غرفة الخادمة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            137 =>
            array (
                'id' => 138,
                'work_category_id' => 6,
                'location' => 'Laundry',
                'arabic' => 'منطقة الغسيل',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            138 =>
            array (
                'id' => 139,
                'work_category_id' => 6,
                'location' => 'Roof',
                'arabic' => 'السطح',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            139 =>
            array (
                'id' => 140,
                'work_category_id' => 7,
                'location' => 'Garage area',
                'arabic' => 'منطقة الكراج',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            140 =>
            array (
                'id' => 141,
                'work_category_id' => 8,
                'location' => 'Driver Room',
                'arabic' => 'غرفه السائق',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            141 =>
            array (
                'id' => 142,
                'work_category_id' => 8,
                'location' => 'Garage Area',
                'arabic' => 'منطقة الكراج',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            142 =>
            array (
                'id' => 143,
                'work_category_id' => 8,
                'location' => 'Foyer',
                'arabic' => 'مدخل الباب الرئيسي',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            143 =>
            array (
                'id' => 144,
                'work_category_id' => 8,
                'location' => 'Men\'s Wash',
                'arabic' => 'مغسلة الرجال',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            144 =>
            array (
                'id' => 145,
                'work_category_id' => 8,
                'location' => 'Men\'s Sitting',
                'arabic' => 'مجلس الرجال',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            145 =>
            array (
                'id' => 146,
                'work_category_id' => 8,
                'location' => 'Dining Room',
                'arabic' => 'غرفة الطعام',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            146 =>
            array (
                'id' => 147,
                'work_category_id' => 8,
                'location' => 'Living Room',
                'arabic' => 'غرفة المعيشة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            147 =>
            array (
                'id' => 148,
                'work_category_id' => 8,
                'location' => 'Nook Area',
                'arabic' => 'منطقة الزاوية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            148 =>
            array (
                'id' => 149,
                'work_category_id' => 8,
                'location' => 'Storage',
                'arabic' => 'منطقة التخزين',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            149 =>
            array (
                'id' => 150,
                'work_category_id' => 8,
                'location' => 'Ladies Sitting',
                'arabic' => 'مجلس النساء',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            150 =>
            array (
                'id' => 151,
                'work_category_id' => 8,
                'location' => 'Ladies Wash',
                'arabic' => 'منطقة مغسلة النساء',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            151 =>
            array (
                'id' => 152,
                'work_category_id' => 8,
                'location' => 'Stairs',
                'arabic' => 'السلالم',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            152 =>
            array (
                'id' => 153,
                'work_category_id' => 8,
                'location' => 'Maid\'s Room',
                'arabic' => 'غرفة الخادمة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            153 =>
            array (
                'id' => 154,
                'work_category_id' => 8,
                'location' => 'Corridor',
                'arabic' => 'الممرات',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            154 =>
            array (
                'id' => 155,
                'work_category_id' => 8,
                'location' => 'Kid\'s Bedroom-1',
                'arabic' => 'غرفة الأطفال 1',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            155 =>
            array (
                'id' => 156,
                'work_category_id' => 8,
                'location' => 'Kid\'s Bedroom-2',
                'arabic' => 'غرفة الأطفال 2',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            156 =>
            array (
                'id' => 157,
                'work_category_id' => 8,
                'location' => 'Laundry Area',
                'arabic' => 'منطقة الغسيل',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            157 =>
            array (
                'id' => 158,
                'work_category_id' => 8,
                'location' => 'Common Wash',
                'arabic' => 'المغسلة المشتركة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            158 =>
            array (
                'id' => 159,
                'work_category_id' => 8,
                'location' => 'Master Bedroom',
                'arabic' => 'غرفة النوم الرئيسية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            159 =>
            array (
                'id' => 160,
                'work_category_id' => 8,
                'location' => 'Master Dresser',
                'arabic' => 'المنطقة الخاصة بالملابس داخل غرفة النوم الرئيسية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            160 =>
            array (
                'id' => 161,
                'work_category_id' => 8,
                'location' => 'Master Wash',
                'arabic' => 'منطقة مغسلة غرفة النوم الرئيسية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            161 =>
            array (
                'id' => 162,
                'work_category_id' => 8,
                'location' => 'Private sitting',
                'arabic' => 'المنطقة الخاصة بالجلوس داخل غرفة النوم الرئيسية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            162 =>
            array (
                'id' => 163,
                'work_category_id' => 8,
                'location' => 'Semi-master bedroom',
                'arabic' => 'غرفة النوم الثانوية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            163 =>
            array (
                'id' => 164,
                'work_category_id' => 8,
                'location' => 'Semi-Master Closet',
                'arabic' => 'خزانة غرفة النوم الثانوية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            164 =>
            array (
                'id' => 165,
                'work_category_id' => 8,
                'location' => 'Roof',
                'arabic' => 'السطح',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            165 =>
            array (
                'id' => 166,
                'work_category_id' => 8,
                'location' => 'Electrical Room',
                'arabic' => 'غرفة الكهرباء',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            166 =>
            array (
                'id' => 167,
                'work_category_id' => 8,
                'location' => 'Telecom Room',
                'arabic' => 'غرفة الاتصالات',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            167 =>
            array (
                'id' => 168,
                'work_category_id' => 9,
                'location' => 'Indoor',
                'arabic' => 'داخلي',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            168 =>
            array (
                'id' => 169,
                'work_category_id' => 9,
                'location' => 'Outdoor',
                'arabic' => 'خارجي',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            169 =>
            array (
                'id' => 170,
                'work_category_id' => 10,
                'location' => 'Garage Area',
                'arabic' => 'منطقة الكراج',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            170 =>
            array (
                'id' => 171,
                'work_category_id' => 10,
                'location' => 'Driver\'s Room',
                'arabic' => 'غرفة السائق',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            171 =>
            array (
                'id' => 172,
                'work_category_id' => 10,
                'location' => 'Driver\'s Toilet',
                'arabic' => 'حمام غرفة السائق',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            172 =>
            array (
                'id' => 173,
                'work_category_id' => 10,
                'location' => 'Men\'s Sitting Room',
                'arabic' => 'مجلس الرجال',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            173 =>
            array (
                'id' => 174,
                'work_category_id' => 10,
                'location' => 'Men\'s Wash Area',
                'arabic' => 'منطقة مغسلة الرجال',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            174 =>
            array (
                'id' => 175,
                'work_category_id' => 10,
                'location' => 'Men\'s Toilet',
                'arabic' => 'حمام الرجال',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            175 =>
            array (
                'id' => 176,
                'work_category_id' => 10,
                'location' => 'Dining Room',
                'arabic' => 'غرفة الطعام',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            176 =>
            array (
                'id' => 177,
                'work_category_id' => 10,
                'location' => 'Living Area',
                'arabic' => 'غرفة المعيشة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            177 =>
            array (
                'id' => 178,
                'work_category_id' => 10,
                'location' => 'Corridor',
                'arabic' => 'الممرات',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            178 =>
            array (
                'id' => 179,
                'work_category_id' => 10,
                'location' => 'Ladies Sitting Room',
                'arabic' => 'مجلس النساء',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            179 =>
            array (
                'id' => 180,
                'work_category_id' => 10,
                'location' => 'Ladies Wash Area',
                'arabic' => 'منطقة مغسلة النساء',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            180 =>
            array (
                'id' => 181,
                'work_category_id' => 10,
                'location' => 'Ladies Toilet',
                'arabic' => 'حمام النساء',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            181 =>
            array (
                'id' => 182,
                'work_category_id' => 10,
                'location' => 'Kitchen',
                'arabic' => 'المطبخ',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            182 =>
            array (
                'id' => 183,
                'work_category_id' => 10,
                'location' => 'Stair',
                'arabic' => 'السلالم',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            183 =>
            array (
                'id' => 184,
                'work_category_id' => 10,
                'location' => 'Master Closet',
                'arabic' => 'خزانه غرفة النوم الرئيسية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            184 =>
            array (
                'id' => 185,
                'work_category_id' => 10,
                'location' => 'Master bedroom',
                'arabic' => 'غرفة النوم الرئيسية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            185 =>
            array (
                'id' => 186,
                'work_category_id' => 10,
                'location' => 'Master Toilet',
                'arabic' => 'حمام غرفة النوم الرئيسية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            186 =>
            array (
                'id' => 187,
                'work_category_id' => 10,
                'location' => 'Ante-Room',
                'arabic' => 'مدخل غرفة النوم الرئيسيه أوالفرعية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            187 =>
            array (
                'id' => 188,
                'work_category_id' => 10,
                'location' => 'Kids Bedroom-1',
                'arabic' => 'غرفة الأطفال 1',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            188 =>
            array (
                'id' => 189,
                'work_category_id' => 10,
                'location' => 'Kids Bedroom-2',
                'arabic' => 'غرفة الأطفال 2',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            189 =>
            array (
                'id' => 190,
                'work_category_id' => 10,
                'location' => 'Common Toilet',
                'arabic' => 'الحمام المشترك',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            190 =>
            array (
                'id' => 191,
                'work_category_id' => 10,
                'location' => 'Common Wash',
                'arabic' => 'المغسلة المشتركة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            191 =>
            array (
                'id' => 192,
                'work_category_id' => 10,
                'location' => 'Semi-Master Bedroom',
                'arabic' => 'غرفة النوم الثانوية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            192 =>
            array (
                'id' => 193,
                'work_category_id' => 10,
                'location' => 'Semi-master Closet',
                'arabic' => 'خزانة غرفة النوم الثانوية',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            193 =>
            array (
                'id' => 194,
                'work_category_id' => 10,
                'location' => 'Semi-Master Toilet',
                'arabic' => 'حمام غرفة الخادمة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            194 =>
            array (
                'id' => 195,
                'work_category_id' => 10,
                'location' => 'Maid\'s Stair Hall',
                'arabic' => 'المنطقة أمام غرفة الخادمة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            195 =>
            array (
                'id' => 196,
                'work_category_id' => 10,
                'location' => 'Maid\'s Room',
                'arabic' => 'غرفة الخادمة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            196 =>
            array (
                'id' => 197,
                'work_category_id' => 10,
                'location' => 'Maid\'s Toilet',
                'arabic' => 'حمام غرفة الخادمة',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            197 =>
            array (
                'id' => 198,
                'work_category_id' => 10,
                'location' => 'Laundry Room',
                'arabic' => 'منطقة الغسيل',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
            198 =>
            array (
                'id' => 199,
                'work_category_id' => 10,
                'location' => 'Storage Room',
                'arabic' => 'غرفة التخزين',
                'created_at' => '2022-07-19 16:08:48',
                'updated_at' => '2022-07-19 16:08:48',
            ),
        ));


    }
}
