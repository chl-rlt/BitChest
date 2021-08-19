<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Market;
use App\Models\Cryptocurrencie;

class MarketController extends Controller
{
    public function index()
    {
        $markets = Market::select('id', 'price')->get();
        $cryptos = Cryptocurrencie::select('name', 'logo')->get();
        return Inertia::render('Market/Index', [
            'markets' => $markets, 'cryptos' => $cryptos
        ]);
    }
}
