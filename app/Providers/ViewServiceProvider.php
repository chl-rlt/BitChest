<?php

namespace App\Providers;

use Inertia\Inertia;
use App\Models\Market;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Inertia::share('initial_latest_markets_values', function() {
            return Market::where('date', Market::max('date'))
                ->orderBy('cryptocurrencie_id', 'asc')
                ->join('cryptocurrencies', 'markets.cryptocurrencie_id', '=', 'cryptocurrencies.id')
                ->select('markets.*','cryptocurrencies.logo','cryptocurrencies.name','cryptocurrencies.tag')
                ->orderBy('cryptocurrencie_id', 'asc')
                ->get();
        });
    }
}
