<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            [
                'user_id' => 2,
                'title' => 'Belajar Laravel Pemula',
                'slug' => 'belajar_laravel_pemula',
                'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley',
                'thumbnail' => 'https://www.angon.co.id/wp-content/uploads/2023/10/1686539179.png',
                'published_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'title' => 'Belajar Javascript Pemula',
                'slug' => 'belajar_javascript_pemula',
                'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley',
                'thumbnail' => 'https://miro.medium.com/v2/resize:fit:1200/0*_bK5vZ69rbZo_Z37.png',
                'published_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'title' => 'Belajar react Pemula',
                'slug' => 'belajar_react_pemula',
                'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley',
                'thumbnail' => 'https://miro.medium.com/v2/resize:fit:1200/0*_bK5vZ69rbZo_Z37.png',
                'published_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'title' => 'Belajar vue Pemula',
                'slug' => 'belajar_vue_pemula',
                'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley',
                'thumbnail' => 'https://miro.medium.com/v2/resize:fit:1200/0*_bK5vZ69rbZo_Z37.png',
                'published_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'title' => 'Belajar java Pemula',
                'slug' => 'belajar_java_pemula',
                'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley',
                'thumbnail' => 'https://miro.medium.com/v2/resize:fit:1200/0*_bK5vZ69rbZo_Z37.png',
                'published_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'title' => 'Belajar html Pemula',
                'slug' => 'belajar_html_pemula',
                'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley',
                'thumbnail' => 'https://miro.medium.com/v2/resize:fit:1200/0*_bK5vZ69rbZo_Z37.png',
                'published_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
