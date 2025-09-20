<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    // protected $products;
    //
    public function index(Request $request)
    {
        $ProductBycategories = Category::with(['products'])->limit(3)->orderBy("id", 'asc')->get()->map(function ($cat) {
            $cat->setRelation('products', $cat->products->take(6));
            return $cat;
        });

        $newArrival = Product::orderBy('id', 'asc')->limit(3)->get();
        // dd($newArrival);

        $categories = Category::all();

        // if (request()->has('c') || request()->has('q')) {
        //     $ProductBycategories = Category::where('title', request()->c)->get();
        //     return redirect()->route('product', ['c' => request()->c, 'q' => request()->q]);
        // }

        if ($request->q || $request->c) {
            // $ProductBycategories = Category::where('title', $request->c)->with(["products" => function ($q) {
            //     $q->where('title', 'like', '%' . request()->q . '%');
            // }])->get();
            $ProductBycategories = Product::where('title', 'like', '%' . request()->q . '%')->whereHas("category", function ($q) {
                request()->c ? $q->where('title', request()->c) : '';
            })->get();
        }

        // dd($ProductBycategories);
        return view('pages.product', compact('ProductBycategories', 'categories', 'newArrival'));
    }
}
