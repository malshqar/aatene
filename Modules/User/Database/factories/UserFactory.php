<?php

namespace Modules\User\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\User\Entities\User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>fake('ar')->name(),
            'email'=>fake('ar')->unique()->email(),
            'password'=>bcrypt('password'),
            'phone_number'=>fake('ar')->unique()->phoneNumber(),
            'email_verified_at'=>now(),
        ];
    }
}

