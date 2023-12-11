<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\DayOfWeek;
use App\Models\Post;
use App\Models\Tag;
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
        Tag::factory(20)->create();
        // Post::factory(20)->create();
        $this->call([
            PermissionSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
            DayOfWeekSeeder::class,
            CategorySeeder::class,
        ]);
    }
}
