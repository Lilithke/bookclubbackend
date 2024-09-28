<?php

namespace Database\Factories;

use App\Models\Members;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payments>
 */
class PaymentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $memberIds = Members::all() -> pluck('id');
        $amount = "5000";
        $paid_at = fake()->dateTimeBetween('-1 month', 'now');


        return [
            "members_id" => fake()->randomElement($memberIds),
            "amount" => $amount,
            "paid_at" => $paid_at,

        ];
    }
}
