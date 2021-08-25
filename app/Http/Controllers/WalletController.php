<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class WalletController extends Controller
{

    public function index($id){

        // get all different crypto purchased by user.id, regroup them by their id and SUM their total quantities and prices
        $purchases = Purchase::where('user_id',$id)
        ->join('markets','markets.id','=','market_id')
        ->join('cryptocurrencies','cryptocurrencies.id','=','cryptocurrencie_id')
        ->selectRaw("
            cryptocurrencies.id as crypto_id,
            cryptocurrencies.name as crypto_name,
            cryptocurrencies.logo as crypto_logo,
            SUM(purchases.quantity) as quantity,
            ROUND(SUM(markets.price * purchases.quantity), 2) as prices"
            )
        ->groupBy('cryptocurrencies.id', 'cryptocurrencies.name', 'cryptocurrencies.logo' )
        ->get();
            return $purchases;
        return Inertia::render('Wallet/Index', ['purchases'=>$purchases]);
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
