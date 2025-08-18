<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'Teknologi']);
        Category::create(['name' => 'Gaya Hidup']);
        Category::create(['name' => 'Olahraga']);
        Category::create(['name' => 'Kuliner']);
    }
}
