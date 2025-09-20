<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Repository\SettingsRepo;

class HomeController extends Controller
{
    //

    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->limit(3)->get();
        $banners = SettingsRepo::load("banner")->getRepo();
        return view('pages.home', compact('products', 'banners'));
    }
}
