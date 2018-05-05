<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Review;
use App\Store;

class ProductController extends Controller
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
    $products = Product::all();
    return response()->json($products);
  }

  public function show($id)
  {
    $product = Product::findOrFail($id);
    $product->reviews = $product->reviews;
    $product->stores = $product->stores;
    return response()->json($product);
  }

  public function store(Request $request)
  {
    $response = new \stdClass();
    try {
      $product = new Product;
      $product->title = $request->get('title');
      $product->brand = $request->get('brand');
      $product->price = $request->get('price');
      $product->image = $request->get('image');
      $product->description = $request->get('description');

      $product->save();

      foreach ($request->get('stores') as $store) {
        $product->stores()->attach($store);
      }
      
      $response->success = true;
    }
    catch(\Exception $e) {
      // $response->message = $e->getMessage();
      $response->success = false;
    }
    return response()->json($response);

  }


}
