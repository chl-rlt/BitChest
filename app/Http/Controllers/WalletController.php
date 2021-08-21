<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class WalletController extends Controller
{

    public function index(){

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
