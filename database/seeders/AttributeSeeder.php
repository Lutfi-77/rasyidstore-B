<?php

namespace Database\Seeders;

use App\Enums\AttributeType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ten diffrent color
        \App\Models\Attribute::factory(10)->create();

        $sizes = ['40', '41', '42', '43', '44'];

        foreach ($sizes as $size) {

            \App\Models\Attribute::firstOrCreate(['title' => $size, 'type' => AttributeType::SIZE], ['meta_attr' => '{}']);
        }
    }
}
