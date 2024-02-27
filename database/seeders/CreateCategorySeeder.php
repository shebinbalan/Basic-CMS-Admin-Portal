<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CreateCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'title' => 'Parenting',
            'description' => 'Parenting Description',
            
        ]);
        Category::create([
            'title' => 'Personal Development',
            'description' => 'Personal Development Productivity Motivation',
            
        ]);
    }
}
