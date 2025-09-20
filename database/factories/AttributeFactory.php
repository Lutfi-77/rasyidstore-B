<?php

namespace Database\Factories;

use App\Enums\AttributeType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attribute>
 */
class AttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->colorName,
            'type' => AttributeType::COLOR,
            'meta_attr' => ['color' => $this->faker->hexColor]
        ];
    }
}
