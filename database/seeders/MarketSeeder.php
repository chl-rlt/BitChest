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

            $firstPrice = $this->getFirstCotation($name);



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
                    $price = $nextPrices + $this->getCotationFor($name);
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

    /**
     * Renvoie la valeur de mise sur le marché de la crypto monnaie
     * @param $cryptoname {string} Le nom de la crypto monnaie
     */
    function getFirstCotation($cryptoname){
        return ord(substr($cryptoname,0,1)) + rand(0, 10);
    }

    /**
     * Renvoie la variation de cotation de la crypto monnaie sur un jour
     * @param $cryptoname {string} Le nom de la crypto monnaie
     */
    function getCotationFor($cryptoname){
        return ((rand(0, 99)>40) ? 1 : -1) * ((rand(0, 99)>49) ? ord(substr($cryptoname,0,1)) : ord(substr($cryptoname,-1))) * (rand(1,10) * .01);
    }
}
