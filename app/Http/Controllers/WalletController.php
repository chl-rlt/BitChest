<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;


class WalletController extends Controller
{
    public function buy(Request $request)
    {
        $validated = $request->validate([
            'quantity' => 'required',
            'bought_at' => 'required',
            'user_id' => 'required',
            'market_id' => 'required'
        ]);

        $purchase= Purchase::create([
            'quantity' => $validated['quantity'],
            'bought_at' => $validated['bought_at'],
        ]);

        return Redirect::route('markets.index')->with('message', 'Successful purchase !');
    }

    public function sell(){

    }
}
