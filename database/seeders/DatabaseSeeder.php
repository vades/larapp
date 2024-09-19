<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TagSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
        ]);
        foreach(range(1, 100) as $i)
        {
            DB::table('category_post')->insert([
                                                   'category_id' => rand(1,10),
                                                   'post_id' => $i
                                               ]);
        }
        foreach(range(1, 100) as $i)
        {
            DB::table('post_tag')->insert([
                                                   'tag_id' => rand(1,20),
                                                   'post_id' => $i
                                               ]);
        }
    }
}
