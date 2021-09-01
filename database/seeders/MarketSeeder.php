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
            $nextPrice;

            for($i=0;$i<30;$i++) {

                if($i===0){
                    DB::table('markets')->insert(
                        [
                        'cryptocurrencie_id' => $key,
                        'price' => $firstPrice,
                        'date' => date('Y-m-d H:i:s', strtotime($i.' day'))
                        ]
                    );
                    $nextPrice = $firstPrice;
                }
                else {
                    $price = getCotationFor($name, $nextPrice);
                    DB::table('markets')->insert(
                        [
                        'cryptocurrencie_id' => $key,
                        'price' => $price,
                        'date' => date('Y-m-d H:i:s', strtotime(" - 1 month + $i day"))
                        ]
                    );
                    $nextPrice = $price;
                }
            }

        }

    }
}
