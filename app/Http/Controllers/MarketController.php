<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index()
    {
        $market = Market::select('id', 'name', 'logo', 'price', 'date');
        return Inertia::render('Market/Index', [
            'market' => $market
        ]);
    }
}
