<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class WalletController extends Controller
{

    public function index()
    {
        $purchases = Purchase::select('id', 'quantity', 'bought_at', 'user_id', 'market_id')->get();
        return Inertia::render('Wallet/Index', [
            'purchases' => $purchases
        ]);
    }


    public function createPurchase()
    {
        $purchases = Purchase::all();
        return Inertia::render('Market/Index', ['purchases'=>$purchase]);
    }

    public function buy(Request $request)
    {
        $validated = $request->validate([
            'quantity' => 'required',
            'bought_at' => 'required',
            'user_id' => 'required',
            'market_id' => 'required'
        ]);

        $purchase = Purchase::create($request->all());

        return Redirect::route('markets.index')->with('message', 'Successful purchase !');
    }

    public function sell(){

    }
}
