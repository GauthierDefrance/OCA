<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Article::create([
            'title' => 'Article de test',
            'summary' => 'Ceci est un article inséré par un seeder.',
            'published_at' => now(),
            'view_path' => 'articles_list.first',
        ]);

        \App\Models\Article::create([
            'title' => 'Article de test 2',
            'summary' => 'Ceci est un article inséré par un seeder une nouvelle fois.',
            'published_at' => now(),
            'view_path' => 'articles_list.second',
        ]);
    }
}
