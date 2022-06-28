<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Product;

class CategoriesController extends Controller
{

//Search by product, join product and category table
    public function category(Request $request){

        //$products = Product::paginate( $request->get('per_page', 4));
        // ->paginate( $request->get('per_page', 1));
       
    // search  from select option tag
        if ( $search = $request->input('category')) {

             $products =Product::join('categories', 'categories.cat_id', '=', 'products.cat_id')
                   
                    ->where('categories.cat_name', 'LIKE', "%{$search}%")
                    ->where('products.prod_status', 'approve') 
                   ->get(['products.*', 'categories.cat_name']);
                return view('category', compact('products'));
            }

// search from input tag
    elseif( $search = $request->input('search')){

       
                  $products = Product::join('categories', 'categories.cat_id', '=', 'products.cat_id')

                    
                    ->orwhere('prod_name', 'LIKE', "%{$search}%") // search by product name

                    // ->orWhere('prod_brand', 'LIKE', "%{$search}%") //search by brand name
                    // ->orWhere('description', 'LIKE', "%{$search}%")// search by product description
                    // ->orwhere('categories.cat_name', 'LIKE', "%{$search}%") // search by category name
                    ->where('products.prod_status', 'approve')

                   ->get(['products.*', 'categories.cat_name']);
        //
                return view('category', compact('products'));
                }

    
    }


// add to cart from category page
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
          
        $cart = session()->get('cart', []);
  
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "prod_name" => $product->prod_name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image,
                "id" => $product->id,
                "seller_id" => $product->seller_id
            ];
        }
          
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }



}
