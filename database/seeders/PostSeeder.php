<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user dan kategori pertama sebagai contoh
        $user = User::first();
        $category = Category::where('name', 'Teknologi')->first();

        if ($user && $category) {
            Post::create([
                'user_id' => $user->user_id,
                'category_id' => $category->category_id,
                'question' => 'Bagaimana cara terbaik belajar Laravel 11?',
                'content' => 'Saya adalah seorang pemula dan ingin tahu langkah-langkah efektif untuk menguasai Laravel 11 dari dasar hingga mahir.',
            ]);

            Post::create([
                'user_id' => $user->user_id,
                'category_id' => $category->category_id,
                'question' => 'Apa perbedaan utama antara Vue dan React?',
                'content' => 'Keduanya adalah framework JavaScript populer, tapi apa saja perbedaan fundamental yang perlu dipertimbangkan saat memilih salah satunya?',
            ]);
        }
    }
}
