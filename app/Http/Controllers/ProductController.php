<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categories;
use App\Models\Voucher;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use App\Models\User;
use App\Mail\LowStockEmail;

use Session;
use Validator;
use Auth;
use Mail;

use Carbon\Carbon;

class ProductController extends Controller
{

      public function __construct()
    {
         // $this->middleware('auth');
       
    }
    //
      public function index( Request $request)
    {

        $products = Product::where('prod_status', 'approve')
                    ->orderBy('created_at', 'desc')
                    ->paginate($request->get('per_page', 4));

        $seller = Arr::pluck($products, 'seller_id');
        $get_seller_id = implode(" ",$seller);

        //get sellers details
        $email          = User::where('id', $get_seller_id)->get('email');
        $seller_details = User::where('id', $get_seller_id)->get();

        $seller_name    = Arr::pluck($seller_details, 'fname');
        $name           = implode(" ",$seller_name);
       

          //send email notification of low stock
        
        foreach($products   as $key => $prod){
             $date = Carbon::tomorrow();
              if($prod->quantity < 1 & $prod->created_at <= $date){
           
            $data = array(
                'name'      => $name,
                'prod_name' => $prod->prod_name,
                'quantity'  => $prod->quantity,  
                'message'   => 'Your product'  
                                            
               );
             Mail::to($email)->send(new LowStockEmail($data));
              //soft delete product from landing page - update status
             Product::where('id', $prod->id)
                    ->update(['prod_status' => 'remove']);
          }

        }
              
        return view('products', compact('products'));
    }
  
    /**
     * my code on Method
     *
     * @return response()
     */
    public function cart()
    {
        return view('cart');
    }
  

    //Search by product, join product and category table
    public function category(Request $request){

        //$products = Product::paginate( $request->get('per_page', 4));
        // ->paginate( $request->get('per_page', 1));
       
        // search  from select option tag
        if ( $search = $request->input('category')) {

             $products =Product::join('categories', 'categories.cat_id', '=', 'products.cat_id')
                   
                    ->where('categories.cat_name', 'LIKE', "%{$search}%") 
                   ->get(['products.*', 'categories.cat_name']);
                return view('products', compact('products'));
            }
        }

   
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
                "id" => $product->id

            ];
        }
          
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
  
   

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
  
   

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');

        }
    }

    
    public function checkout(Request $request){

         if( Auth::user()){
     
        //get voucher from input
        $id = Auth::user()->id;// get user id for the login member

          $cart = session()->get('cart');
          $cart[$request->id]["quantity"] = $request->quantity;
          $cart[$request->id]["price"] = $request->price;

          $totalAmount = 0;

        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];

            // check if sufficient credit limit
             $getcredit = \DB::table('vouchers')->where('user_id', $id)->first()->credit;

           if($getcredit < $totalAmount){

            Session::flash('credit', ' You Have Insufficient Credit Limit. Contact Your Cooperative!'); 
            Session::flash('alert-class', 'alert-danger'); 

           }

            }//foreach

           $voucher = Voucher::join('users', 'users.id', '=', 'vouchers.user_id')
                    ->where('vouchers.user_id', $id)
                    ->get(['vouchers.*', 'users.*']); 

        return view('checkout', compact('voucher'));
    }

        else { return Redirect::to('/login');}

        }

      

  public function addToCartPreview($id)
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
                "id" => $product->id

            ];
        }
          
        session()->put('cart', $cart);
        return redirect()->route('cart')->with('success', 'Product added to cart successfully!');
    }


public function preview(Request $request, $prod_name)
{
   $products = Product::where('prod_name', $prod_name)->get('*');

     return view('preview', compact('products'));
}


 
}//class
