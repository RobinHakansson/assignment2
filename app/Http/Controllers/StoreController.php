<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Store;

class StoreController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $stores = Store::all();
        return response()->json($stores);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }


}
