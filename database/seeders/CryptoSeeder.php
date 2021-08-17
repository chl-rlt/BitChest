<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CryptoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $crypto = [
            'Bitcoin' => 'bitcoin.png',
            'Ethereum' => 'ethereum.png',
            'Ripple' => 'ripple.png',
            'Bitcoin Cash' => 'bitcoin-cash.png',
            'Cardano' => 'cardano.png',
            'Litecoin' => 'litecoin.png',
            'NEM' => 'nem.png',
            'Stellar' => 'stellar.png',
            'IOTA' => 'iota.png',
            'Dash' => 'dash.png'
        ];

        foreach($crypto as $key => $val) {
            DB::table('cryptocurrencies')->insert(
                [
                    'name' => $key,
                    'logo' => $val
                ],
            );
        }
    }
}
