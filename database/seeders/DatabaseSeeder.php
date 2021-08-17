<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CryptoSeeder;
use Database\Seeders\MarketSeeder;
use Database\Seeders\PurchaseSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CryptoSeeder::class,
            MarketSeeder::class,
            PurchaseSeeder::class,
        ]);
    }
}
