<?php

namespace Database\Factories;
use App\Models\BarAssociation;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Advocate;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advocate>
 */
class AdvocateFactory extends Factory
{
    protected $model = Advocate::class;

    public function definition(): array
    {
        // Ensure you have at least one BarAssociation record to pull from
        $barAssociationId = BarAssociation::inRandomOrder()->first()?->id ?? BarAssociation::factory()->create()->id;

        return [
            'bar_association_id' => $barAssociationId,
            'name' => fake()->firstName() . ' ' . fake()->lastName(),
            'father_husband_name' => fake()->name(),
            'complete_address' => fake()->address(),
            'visitor_member_of_bar_association' => fake()->randomElement(['Yes', 'No', null]),
            'date_of_enrolment_lower_courts' => fake()->date('Y-m-d', '2010-01-01'),
            'date_of_enrolment_high_court' => fake()->optional(0.5)->date('Y-m-d', '2015-01-01'),
            'date_of_enrolment_supreme_court' => fake()->optional(0.2)->date('Y-m-d', '2020-01-01'),
            'voter_member_of_bar_association' => fake()->optional(0.8)->date('Y-m-d', '2018-01-01'),
            'duration_of_practice' => fake()->date('Y-m-d', '2005-01-01'),
            'mobile_no' => fake()->unique()->numerify('##########'),
            'email_address' => fake()->unique()->safeEmail(),
            'is_active' => fake()->boolean(90), // 90% chance of being active
        ];
    }
}
