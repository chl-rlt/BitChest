<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class WalletController extends Controller
{

    public function index($id){

        // get all different crypto purchased by user.id, regroup them by their id and SUM their total quantities and prices
        $purchases = Purchase::where('user_id',$id)
        ->holding()
        ->join('markets','markets.id','=','market_id')
        ->join('cryptocurrencies','cryptocurrencies.id','=','cryptocurrencie_id')
        ->selectRaw("
            cryptocurrencies.id as crypto_id,
            cryptocurrencies.name as crypto_name,
            cryptocurrencies.logo as crypto_logo,
            ROUND(SUM(purchases.quantity), 2) as quantity,
            ROUND(SUM(markets.price * purchases.quantity), 2) as prices"
            )
        ->groupBy('cryptocurrencies.id', 'cryptocurrencies.name', 'cryptocurrencies.logo' )
        ->get();

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

    public function sell(Request $request){

        $user = Auth::user()->id;

        $purchases = Purchase::holding()
        ->join('markets', 'market_id', '=', 'markets.id')
        ->where(['markets.cryptocurrencie_id' => $request->input('id'), 'user_id' => $user])
        ->select('purchases.id', 'quantity', 'bought_at', 'user_id', 'market_id', 'status')->get();


        foreach($purchases as $purchase) {
            $purchase->update(['status' => 'sold']);
        }

        return Redirect::route('wallet.index', $user)->with('message', 'Crypto successfuly sold !');

    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(int $user_id, int $crypto_id) {

        $purchase = Purchase::holding()
        ->join('markets', 'market_id','=','markets.id')
        ->join('cryptocurrencies','markets.cryptocurrencie_id','=','cryptocurrencies.id')
        ->where(['user_id'=> $user_id, 'cryptocurrencie_id' => $crypto_id])
        ->orderBy('bought_at', 'DESC')
        ->get();

        return Inertia::render('Wallet/Show', ['purchase' => $purchase]);
    }
}
