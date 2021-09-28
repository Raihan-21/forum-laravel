<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\User;
use App\Models\Discussion;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Category::insert([['name' => 'Node.js'], ['name' => 'Laravel']]);
        User::create([
            'name' => 'Raihan', 
            'email' => 'raihan@gmail.com',
            'password' => Hash::make('test1234')
        ]);
        Discussion::create([
            'user_id' => 1,
            'title' => 'First Post',
            'slug' => Str::slug('First Post'),
            'content' => 'This is s question on a discussion forum',
            'category_id' => 1
        ]);
    }
}
