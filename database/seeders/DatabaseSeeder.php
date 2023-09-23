<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\BlogPost;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      Author::factory()->count(10)->create()->each(function ($author) {
        // Create posts for each author as required
        BlogPost::factory()->count(10)->create([
            'author_id' => $author->id,
            'is_published' => true,
            'status' => 'Approved'
        ]);
    });
    
    }
}
