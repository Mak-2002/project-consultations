<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\{User, Consultation, ConsultType, Appointment, Chat, Expert, Favorite, Message, WorkDay};


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sender_id' =>$this->faker->numberBetween(0, 10),
            'receiver_id' =>$this->faker->numberBetween(0, 10),
            'chat_id'=>Chat::factory(),
            'content' => $this->faker->sentence,
        ];
    }
}
