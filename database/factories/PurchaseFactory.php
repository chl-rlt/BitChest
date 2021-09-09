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
        $data = [
            'quantity'=>$this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 5),
            'status'=> $this->faker->randomElement($array = array('sold','holding')),
        ];

        if($data['status'] == 'sold') {
            $data['selling_price'] = $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 300);
        }

        return $data;
    }
}
