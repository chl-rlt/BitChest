<?php

namespace Database\Factories;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Factories\Factory;


class PurchaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Purchase::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quantity'=>$this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 5),
            'bought_at'=>$this->faker->dateTime(),
            'status'=> $this->faker->randomElement($array = array('sold','holding')),
        ];
    }
}
