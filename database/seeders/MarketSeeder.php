<?php

namespace Database\Seeders;

use App\Models\Date;
use App\Models\Market;
use App\Models\Cryptocurrencie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $crypto = Cryptocurrencie::pluck('name', 'id')->all();

        foreach($crypto as $key => $name) {

            $firstPrice = getFirstCotation($name);



            for($i=0;$i<30;$i++) {

                $nextPrices;

                if($i===0){
                    DB::table('markets')->insert(
                        [
                        'cryptocurrencie_id' => $key,
                        'price' => $firstPrice,
                        'date' => date('Y-m-d H:i:s', strtotime($i.' day'))
                        ]
                    );
                    $nextPrices = $firstPrice;
                }
                else {
                    $price = $nextPrices + getCotationFor($name);
                    DB::table('markets')->insert(
                        [
                        'cryptocurrencie_id' => $key,
                        'price' => $price,
                        'date' => date('Y-m-d H:i:s', strtotime(" - 1 month + $i day"))
                        ]
                    );
                    $nextPrices = $price;
                }
            }

        }

    }
}
