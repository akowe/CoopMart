<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Voucher;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingDetail;
use App\Models\Transaction;
use App\Models\Product;


use Auth;
use Validator;
use Session;
use Paystack;


class SuperAdminController extends Controller
{
    //
      public function __construct()
    {
         $this->middleware(['auth','verified']);
            $this->middleware('superadmin');
    }


    public function index(Request $request)
    {
          if( Auth::user()->role_name  == 'superadmin'){
     // select all user except the current login
        $users = User::all()->except(Auth::id());

        $cooperatives = User::where('role', '2')->get('*');
        $sellers = User::where('role', '3')->get('*');
        $members = User::where('role', '4')->get('*');

                        // count orders 
         $count_orders = User::join('orders', 'orders.user_id', '=', 'users.id')
                        ->leftjoin('order_items', 'order_items.order_id', '=', 'orders.id')
                          ->orwhere('order_items.status', 'confirmed')
                         ->orwhere('order_items.status', 'paid');
                      
                         //select all orders from members
         $orders = User::join('orders', 'orders.user_id', '=', 'users.id')
                          ->leftjoin('order_items', 'order_items.order_id', '=', 'orders.id')
                         ->where('order_items.status', 'confirmed')
                         ->orwhere('order_items.status', 'paid')
                        ->orderBy('order_id', 'desc')
                         ->paginate( $request->get('per_page', 5));                   
                       //->get(['orders.*', 'users.*', 'order_items.*']);

        // count credit from members
        // $credit = Voucher::join('users', 'users.id', '=', 'vouchers.user_id')
        //                ->get('credit');

        // sum total order paid for by cooperative for his from members
        $sales = Transaction::join('users', 'users.id', '=', 'transactions.user_id')
                       ->get('tran_amount');

        $products = Product::all();

        return view('company.admin', compact('cooperatives', 'sellers', 'members', 'count_orders', 'orders', 'sales', 'products', 'users'));
    }
    else { return Redirect::to('/login');}
   
    }
 

    public function sales_invoice(Request $request, $order_id )
    {
     if( Auth::user()->role_name  == 'superadmin'){
    
        $item = Order::join('users', 'users.id', '=', 'orders.user_id')// count orders from members
                          ->leftjoin('order_items', 'order_items.order_id', '=', 'orders.id')
                           ->join('shipping_details', 'shipping_details.shipping_id', '=', 'orders.id')
                             ->join('products', 'products.id', '=', 'order_items.product_id')
                              ->join('vouchers', 'vouchers.user_id', '=', 'users.id')
        
                        ->where('order_id', $order_id)
                        ->get(['vouchers.*', 'orders.*', 'users.*', 'order_items.*', 'shipping_details.*', 'products.*'])->first();

         $orders = Order::join('users', 'users.id', '=', 'orders.user_id')// count orders from members
                          ->leftjoin('order_items', 'order_items.order_id', '=', 'orders.id')
                           ->join('shipping_details', 'shipping_details.shipping_id', '=', 'orders.id')
                             ->join('products', 'products.id', '=', 'order_items.product_id')
                              ->join('vouchers', 'vouchers.user_id', '=', 'users.id')
                         // ->where('order_items.status', 'confirmed')
                         // ->orwhere('order_items.status', 'paid')
                        ->where('order_id', $order_id)
                        ->get(['orders.*', 'users.*', 'order_items.*', 'shipping_details.*', 'products.*', 'vouchers.*']);

    return view('invoice', compact('item', 'orders'));
           }

    else { return Redirect::to('/login');
    
        }             
    }

  
   public function products_list(Request $request){
  
      if( Auth::user()->role_name  == 'superadmin'){
         //view all products from sellers
        $products = User::join('products', 'products.seller_id', '=', 'users.id')
                         ->where('products.prod_status', 'pending')
                         ->orwhere('products.prod_status', 'approve')
                        ->paginate( $request->get('per_page', 4));
                       //->get(['products.*', 'users.*']);
                        
                         // count products from members
        $count_product = User::join('products', 'products.seller_id', '=', 'users.id')
                          ->where('products.prod_status', 'pending')
                         ->orwhere('products.prod_status', 'approve');
       
       return view('company.products_list', compact('products', 'count_product'));

       }

    else { return Redirect::to('/login');}
   
    }



    public function mark_paid(Request $request)
    {

        if(null !== $_POST['submit'])
        {
            $order_id  = $request->input('order_id');
             //$input  = $request->input('p');

             //mark order as paid
            \DB::table('order_items')
                ->where('order_id', $order_id)
                ->update(['status' => 'Paid']);

            Session::flash('pay', ' You have marked this orders as  "Paid !".'); 
            Session::flash('alert-class', 'alert-success'); 
           
        }

            //return view('cooperative.credit_limit', compact('credit'));
             return redirect()->back()->with('success', 'You have marked this orders as  "Paid !".');

}


  public function approved(Request $request)
    {

        if(null !== $_POST['submit'])
        {
            $id  = $request->input('id');
             //$input  = $request->input('p');

             //mark order as paid
            \DB::table('products')
                ->where('id', $id)
                ->update(['prod_status' => 'approve']);

            Session::flash('approve', ' Product approved successful!.'); 
            Session::flash('alert-class', 'alert-success'); 
           
        }

            //return view('cooperative.credit_limit', compact('credit'));
             return redirect()->back()->with('success', 'Product approved successful!..');

}



 public function users_list(Request $request){
  
      if( Auth::user()->role_name  == 'superadmin'){
       //view all coop 
          $coop = Voucher::join('users', 'users.id', '=', 'vouchers.user_id')
                        ->where('users.role', '2')
                        ->paginate( $request->get('per_page', 5));
                       //->get(['vouchers.*', 'users.*']);
        // }
       
    //view all coop members
       $members = Voucher::join('users', 'users.id', '=', 'vouchers.user_id')
                        ->where('users.role', '4')
                        ->paginate( $request->get('per_page', 5));

                        //view all coop members
       $merchants = User::where('users.role', '3')
                        ->paginate( $request->get('per_page', 5));

       return view('company.users_list', compact('coop', 'members', 'merchants'));

       }

    else { return Redirect::to('/login');}
   
    }



 public function transactions(Request $request){
  
      if( Auth::user()->role_name  == 'superadmin'){
       //view all transactions by cooperatives
          $transactions = Transaction::join('users', 'users.id', '=', 'transactions.user_id')
                        ->leftjoin('order_items', 'order_items.order_id', '=', 'transactions.order_id')
                        ->where('users.role', '2')
                        ->orderBy('date', 'desc')
                        ->paginate( $request->get('per_page', 5));
                       //->get(['vouchers.*', 'users.*']);
        // }
       


       return view('company.transactions', compact('transactions'));

       }

    else { return Redirect::to('/login');}
   
    }


}//class
