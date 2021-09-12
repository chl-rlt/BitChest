<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Builder;


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
            cryptocurrencies.tag as crypto_tag,
            ROUND(SUM(purchases.quantity), 2) as quantity,
            ROUND(SUM(markets.price * purchases.quantity), 2) as prices",
            )
        ->groupBy('cryptocurrencies.id', 'cryptocurrencies.name', 'cryptocurrencies.logo', 'cryptocurrencies.tag' )
        ->get();

        $sold = Purchase::where('user_id',$id)->sold()
        ->with('market.cryptocurrencie')
        ->get();

        return Inertia::render('Wallet/Index', ['purchases'=>$purchases, 'sold'=>$sold]);
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

        return Redirect::route('markets.index')->with('message', [
            'status' => 'success',
            'message' => 'Successful purchase !'
        ]);
    }

    // SELL ALL PURCHASES OF ONE CRYPTO
    public function sellAll(Request $request){

        $user = Auth::user()->id;

        $purchases = Purchase::holding()
        ->join('markets', 'market_id', '=', 'markets.id')
        ->where(['markets.cryptocurrencie_id' => $request->input('id'), 'user_id' => $user])
        ->select('purchases.*')->get();

        foreach($purchases as $purchase) {
            $purchase->update(['status' => 'sold','selling_price' => $request->input('selling_price')]);
        }

        return Redirect::route('wallet.index', $user)->with('message', [
            'status' => 'success',
            'message' => 'Crypto successfully sold !'
        ]);

    }

    /**
    * @param int $id purchase.id
    *
    */
    // SELL ONE PURCHASE
    public function sell(int $id){

        $user = Auth::user()->id;

        // verify connected user is the rightfull holder
        $purchase = Purchase::where(['id' => $id, 'user_id' => $user])->with('market')->firstOrFail();
        $purchase->update(['status' => 'sold']);

        return Redirect::route('wallet.index', $user)->with('message', [
            'status' => 'success',
            'message' => 'Crypto successfully sold !'
        ]);

    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @param  int  $crypto_id
    * @return \Illuminate\Http\Response
    */
    public function show(int $user_id, int $crypto_id) {

        $purchases = Purchase::holding()
        ->join('markets', 'market_id','=','markets.id')
        ->join('cryptocurrencies','markets.cryptocurrencie_id','=','cryptocurrencies.id')
        ->where(['user_id'=> $user_id, 'cryptocurrencie_id' => $crypto_id])
        ->orderBy('created_at', 'DESC')
        ->select('purchases.*',
        'cryptocurrencies.name', 'cryptocurrencies.logo', 'cryptocurrencies.tag',
        'markets.cryptocurrencie_id', 'markets.id as market_id', 'markets.date', 'markets.price')
        ->get();

        return Inertia::render('Wallet/Show', ['purchases' => $purchases]);
    }
}
