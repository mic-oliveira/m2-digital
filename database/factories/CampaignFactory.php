<?php

namespace Database\Factories;

use App\Enums\CampaignStatusEnum;
use App\Models\Campaign;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'status' => $this->faker->randomElement(CampaignStatusEnum::listValues()),
            'description' => $this->faker->text(30)
        ];
    }
}
