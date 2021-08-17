<?php

namespace Database\Seeders;

use App\Models\Market;
use App\Models\Purchase;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Purchase::factory()
        ->count(5)
        ->create([
            'user_id' => '2'
        ])
        ->each(function($purchase) {
            $market = Market::pluck('id')->shuffle()->first();
            $purchase->market()->associate($market);
            $purchase->save();
        });

    }
}
