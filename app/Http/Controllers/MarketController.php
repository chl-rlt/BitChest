<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Market;
use App\Models\Cryptocurrencie;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;

class MarketController extends Controller
{
    public function index()
    {
        $markets = DB::table('markets')
            ->whereBetween('date', [date('Y-m-d H:i:s', strtotime('- 24 hours')), date('Y-m-d H:i:s')])
            ->orderBy('date', 'desc')
            ->offset(10)
            ->limit(
                DB::table('markets')->whereBetween('date', [date('Y-m-d H:i:s', strtotime('- 24 hours')), date('Y-m-d H:i:s')])->count()
                )
            ->get();

        return Inertia::render('Market/Index', [
            'markets' => $markets
        ]);

    }

    public function show($id)
    {
        $crypto = Cryptocurrencie::find($id);
        $markets = Market::select('id', 'price', 'cryptocurrencie_id', 'date')
            ->where('cryptocurrencie_id', $id)
            ->orderBy('date', 'desc')
            ->get();

        return Inertia::render('Market/Show', ['cryptoShow' => $crypto, 'markets' => $markets ]);
    }

    public function getLastValues() {
        $last_markets = Market::orderByDesc('date')->take(10)->get();
        dd($last_markets);
    }

}

