<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat =  collect(['Sepatu', 'Sendal', 'Sockwear']);

        $cat->each(function ($c) {
            Category::create([
                'title' => $c,
                'banner' => '',
            ]);
        });
    }
}
