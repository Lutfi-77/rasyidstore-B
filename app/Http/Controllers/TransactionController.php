<?php

namespace App\Http\Controllers;

use App\Enums\CODState;
use App\Enums\TransactionType;
use App\Http\Resources\TransactionProductResource;
use App\Models\Address;
use App\Models\Order;
use App\Models\ProductVariant;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Transaction/List', ['data' => Transaction::where('user_id', Auth::user()->id)->with('address', 'user')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $items = $this->getItemsBySource($request);

        // dd(new TransactionProductResource($items));
        return Inertia::render('Transaction/Create', ['items' => TransactionProductResource::collection($items), 'addresses' => Auth::user()->addresses, 'source' => $request->get('source', 'product')]);
    }

    function getItemsBySource(Request $request)
    {

        $source = $request->get('source', 'product');

        $items = $source === "product" ?  [new Order(['prod_variant_id' => $request->get('variant_id'), 'quantity' => 1])] : Auth::user()->cart;

        // dd($items['product']->variants);

        return $items;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->variant);
        $transaction = Transaction::create([
            'user_id' => Auth::user()->id,
            'address_id' => $request->get('address'),
            'state' => CODState::TRANSACTION,
            'type' => TransactionType::COD,
            'total_amounts' => 0,
            'estimate_shipping_price' => 0,
            'awb' => '',
        ]);


        if ($request->get('source') === "product") {
            $prod_variant_id = array_keys($request->variant)[0];
            $quantity = $request->variant[$prod_variant_id];
            $order = Order::create([
                'transaction_id' => $transaction->id,
                'user_id' => Auth::user()->id,
                'prod_variant_id' => $prod_variant_id,
                'quantity' => $quantity,
            ]);


            $transaction->total_amounts = $order->product->price * $quantity;
        }

        if ($request->get('source') === 'cart') {
            $variant = $request->variant;
            $orders = Order::find(array_keys($variant));

            foreach ($orders as $order) {
                $quantity = $variant[$order->id];
                $order->update([
                    'transaction_id' => $transaction->id,
                    'quantity' => $variant[$order->id],
                ]);

                $transaction->total_amounts += $order->product->price * $quantity;
            }
        }

        $transaction->save();

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        // dd(CODState::from($request->state), $request->all());
        $transaction->update(['state' => CODState::from($request->state)]);

        // dd($transaction);
        return redirect()->route('transaction.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
