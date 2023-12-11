<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = Setting::create([
            'created_by' => 1,
            'tab_icon' => 'Police Radio',
            'nav_logo' => 'Police Radio',
            'en_nav_title' => 'Police Radio',
            'da_nav_title' => 'رادیو پولیس',
            'pa_nav_title' => 'پولیس رادیو',
            'en_nav_subtitle' => 'Afghanistan People Voice',
            'da_nav_subtitle' => 'صدای مردم افغانستان',
            'pa_nav_subtitle' => 'د خلق آواز',
            'phone' => 'phone',
            'email' => 'email',
            'en_province' => 'Kabul',
            'da_province' => 'کابل',
            'pa_province' => 'کابل',
            'en_street' => 'Kabul Airport Street',
            'da_street' => 'سرک میدان هوایی کابل',
            'pa_street' => 'د کابل هوایی دگر سرک',
            'en_exact_address' => 'Kabul Airport 80m Street Near to Chaharahi Shahed',
            'da_exact_address' => 'سرک 80 متره میدان هوایی کابل نزدیک چهارای شهید',
            'pa_exact_address' => 'سرک 80 متره میدان هوایی کابل نزدیک چهارای شهید',
            'map_location' => 'map_location',
            'en_about_us' => 'This is some information about the radio and its cheif excutive which is lacted at Kabul Airport 80m Street Near to Chaharahi Shahed and it is a test data which will not be used as production level for the mentioned websit This is some information about the radio and its cheif excutive which is lacted at Kabul Airport 80m Street Near to Chaharahi Shahed and it is a test data which will not be used as production level for the mentioned websit This is some information about the radio and its cheif excutive which is lacted at Kabul Airport 80m Street Near to Chaharahi Shahed and it is a test data which will not be used as production level for the mentioned websit This is some information about the radio and its cheif excutive which is lacted at Kabul Airport 80m Street Near to Chaharahi Shahed and it is a test data which will not be used as production level for the mentioned websit ',
            'da_about_us' => 'جاواا سکریپت )JavaScript )زبان برنامهنوی سی سطح باالو پویا مبتنی بر شی ا ست. از JS در کنار HTML و CSS ،به 
            عنوان یکی از سه هسته تشکی دهنده صفحات وب، یاد میشود. البته استفاده از JS فقط به سمت کاربر )end-Front )
            خالصه نمیشود و امروزه میتوان با فریمورکهایی مانند js.vue برنامه نویسی سمت سرور )end-Back )نیز انجام داد. 
            پخخس مخخیتخخوان جخخاوااسخخخخکخخریخخپخخت)JS )را یخخک زبخخان بخخرنخخامخخهنخخویسخخخخی Side Both دانسخخخخت.
            بر خالف ت شابه ا سمی دو زبان برنامه نوی سی جاوا )Java )و جاواا سکریپت )JavaScript )و باور عدهای که هر دو را یک 
            ز بان قل مداد میکن ند، ایب دو هیز ارت باطی با 
            یکدیگر، جز تشخخخابه اسخخخمی، ندارند. سخخخاختار 
            جاوااسکریپت شباهت زیادی به جاوا و ++C دارد. 
            جاوااسخخخکریپت زبان برنامهنویسخخخی شخخخیشرایی 
            )Oriented-Object )و ساخت یافته )Structured )
            اسخت. با ایب زبان میتوان به محتوای داخ html
            دسترسی پیدا کرد.
            ',
            'pa_about_us' => 'جاواا سکریپت )JavaScript )زبان برنامهنوی سی سطح باالو پویا مبتنی بر شی ا ست. از JS در کنار HTML و CSS ،به 
            عنوان یکی از سه هسته تشکی دهنده صفحات وب، یاد میشود. البته استفاده از JS فقط به سمت کاربر )end-Front )
            خالصه نمیشود و امروزه میتوان با فریمورکهایی مانند js.vue برنامه نویسی سمت سرور )end-Back )نیز انجام داد. 
            پخخس مخخیتخخوان جخخاوااسخخخخکخخریخخپخخت)JS )را یخخک زبخخان بخخرنخخامخخهنخخویسخخخخی Side Both دانسخخخخت.
            بر خالف ت شابه ا سمی دو زبان برنامه نوی سی جاوا )Java )و جاواا سکریپت )JavaScript )و باور عدهای که هر دو را یک 
            ز بان قل مداد میکن ند، ایب دو هیز ارت باطی با 
            یکدیگر، جز تشخخخابه اسخخخمی، ندارند. سخخخاختار 
            جاوااسکریپت شباهت زیادی به جاوا و ++C دارد. 
            جاوااسخخخکریپت زبان برنامهنویسخخخی شخخخیشرایی 
            )Oriented-Object )و ساخت یافته )Structured )
            اسخت. با ایب زبان میتوان به محتوای داخ html
            دسترسی پیدا کرد.',
        ]);


        // $image = Storage::disk('all_images')->put(date('Y') . '/' . date('m') . '/' . date('d'), $request->file('image'));
        // $tab_icon = Storage::disk('all_images')->put(date('Y') . '/' . date('m') . '/' . date('d'), "C:\Users\Mujtaba Omari\Documents\GitHub\Radio\storage\app\public\all_images\2023\10\14\1.png");
        // $setting->images()->create(['image' => $tab_icon]);

        // $nav_icon = Storage::disk('all_images')->put(date('Y') . '/' . date('m') . '/' . date('d'), "C:\Users\Mujtaba Omari\Documents\GitHub\Radio\storage\app\public\all_images\2023\10\14\1.png')");
        // $setting->images()->create(['image' => $nav_icon]);
    }
}