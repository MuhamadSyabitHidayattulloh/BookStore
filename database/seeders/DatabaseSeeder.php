<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(3)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@bookstore.com',
            'role' => 'admin',
        ]);

        $category = ['Aksi', 'Adventure', 'Animasi', 'Biografi', 'Fantasi', 'Fiksi Ilmiah', 'Horor', 'Misteri', 'Romantis', 'Sejarah'];
        foreach ($category as $cat) {
            Category::factory()->create([
                'name' => $cat
            ]);
        }

        Book::factory(20)->create();
    }
}
