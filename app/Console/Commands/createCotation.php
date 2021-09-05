<?php

namespace App\Console\Commands;

use App\Models\Market;
use App\Models\Cryptocurrencie;
use Illuminate\Console\Command;
use App\Events\NewMarketQuotation;
use Illuminate\Support\Facades\DB;

class CreateCotation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cotation:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create cotation for cryptos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $markets = Market::where('date', Market::max('date'))->orderBy('cryptocurrencie_id', 'asc')
        ->join('cryptocurrencies','markets.cryptocurrencie_id','=','cryptocurrencies.id')
        ->get();
        $newMarket;
        foreach($markets as $market) {
            $newMarket[] = Market::create([
                "price" => getCotationFor($market['name'], $market['price']),
                "date" => date('Y-m-d H:i:s'),
                "cryptocurrencie_id" => $market['cryptocurrencie_id']
            ]);
        }
        broadcast(new NewMarketQuotation($newMarket));
    }
}


