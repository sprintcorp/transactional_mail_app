<?php

namespace Database\Factories;


use App\Models\Email;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Emailfactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Email::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sender' => $this->faker->email,
            'recipient' => $this->faker->email,
            'subject' => $this->faker->text(),
            'html_content' => $this->faker->randomHtml(),
            'text_content' => $this->faker->text(),
        ];
    }
}
