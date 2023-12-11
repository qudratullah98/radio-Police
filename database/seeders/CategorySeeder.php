<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(
            [
                'en_name' => 'Afghanistan',
                'da_name' => 'افغانستان',
                'pa_name' => 'افغانستان',
                'main_menu' => "1",
                'status' => "1",
                'created_by' => "1"
            ]
        );
        Category::create(
            [
                'en_name' => 'Economic',
                'da_name' => 'اقتصاد',
                'pa_name' => 'اقتصاد',
                'main_menu' => "1",
                'status' => "1",
                'created_by' => "1"
            ]
        );
        Category::create(
            [
                'en_name' => 'Security',
                'da_name' => 'امینت',
                'pa_name' => 'امینت',
                'main_menu' => "1",
                'status' => "1",
                'created_by' => "1"
            ]
        );
        Category::create(
            [
                'en_name' => 'Comedy Show',
                'da_name' => 'تمثیل',
                'pa_name' => 'تمثیل',
                'main_menu' => "1",
                'status' => "1",
                'created_by' => "1"
            ]
        );
        Category::create(
            [
                'en_name' => 'Week Best Program',
                'da_name' => 'بهترین نشریه هفته',
                'pa_name' => 'داونۍ غوره خپرونې',
                'main_menu' => "1",
                'status' => "1",
                'created_by' => "1"
            ]
        );
        Category::create(
            [
                'en_name' => 'Health',
                'da_name' => 'صحت',
                'pa_name' => 'روغتیا',
                'main_menu' => "1",
                'status' => "1",
                'created_by' => "1"
            ]
        );
        Category::create(
            [
                'en_name' => 'Science and Technology',
                'da_name' => 'ساینس و تکنالوژی',
                'pa_name' => 'ساینس او ټیکنالوژي',
                'main_menu' => "1",
                'status' => "1",
                'created_by' => "1"
            ]
        );
        Category::create(
            [
                'en_name' => 'Sport',
                'da_name' => 'ورزش',
                'pa_name' => 'لوبې',
                'main_menu' => "1",
                'status' => "1",
                'created_by' => "1"
            ]
        );
        Category::create(
            [
                'en_name' => 'World',
                'da_name' => 'جهان',
                'pa_name' => 'نړۍ',
                'main_menu' => "1",
                'status' => "1",
                'created_by' => "1"
            ]
        );

        Category::create(
            [
                'en_name' => 'Messages and Notifications',
                'da_name' => 'پیام ها و اعلان ها',
                'pa_name' => 'پیغامونه او خبرتیاوې',
                'main_menu' => "1",
                'status' => "1",
                'created_by' => "1"
            ]
        );
        Category::create(
            [
                'en_name' => 'Print Media',
                'da_name' => 'رسانه چاپی',
                'pa_name' => 'چاپي رسنۍ',
                'main_menu' => "1",
                'status' => "1",
                'created_by' => "1"
            ]
        );
    }
}
