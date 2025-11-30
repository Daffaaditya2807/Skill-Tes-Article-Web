<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 1; $i <= 20; $i++) {

            $title = $faker->sentence(6);
            $slug  = Str::slug($title . '-' . Str::random(6));

            DB::table('articles')->insert([
                'id'         => (string) Str::uuid(),
                'title'      => $title,
                'image'      => null,
                'deskripsi'  => $faker->paragraph(8, true),
                'slug'       => $slug,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
