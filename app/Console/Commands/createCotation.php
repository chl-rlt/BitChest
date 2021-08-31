<?php

namespace App\Console\Commands;

use App\Models\Cryptocurrencie;
use Illuminate\Console\Command;

class createCotation extends Command
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
    public function handle($cryptos)
    {
        // $crypto = Cryptocurrencie::pluck('name', 'id')->all();

        return 0;
    }
}

    // function getCotationFor($cryptoname){
    //     return ((rand(0, 99)>40) ? 1 : -1) * ((rand(0, 99)>49) ? ord(substr($cryptoname,0,1)) : ord(substr($cryptoname,-1))) * (rand(1,10) * .01);
    // }
