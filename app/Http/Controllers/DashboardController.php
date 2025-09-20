<?php

namespace App\Http\Controllers;

use App\Http\Resources\DashboardResource;
use App\Models\Order;
// use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $transaction = Order::where([['user_id', '=', Auth::user()->id], ['transaction_id', '!=', null]])->with('transaction')->get();
        // dd($transaction);
        return Inertia::render('Dashboard', ['data' => DashboardResource::collection($transaction)]);
    }
}
