<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Voucher;
use App\Models\Order;
use App\Models\ShippingDetail;
use App\Models\Transaction;



use Auth;
use Validator;
use Session;
use Paystack;




class CooperativeController extends Controller
{
    
    //
      public function __construct()
    {
         // $this->middleware('auth');
          $this->middleware(['auth','verified']);
        $this->middleware('cooperative');
        
    }


    public function index (Request $request)
    {
    if( Auth::user()->role_name  == 'cooperative'){
     // count all members belonging to a cooperative
        $code = Auth::user()->code; // get the code for the logedin cooperative

      // select all user except the current login
        $members = User::all()->except(Auth::id())
                    ->where('code', $code);

                        // count orders from members
        $count_orders = User::join('orders', 'orders.user_id', '=', 'users.id')
                            ->leftjoin('order_items', 'order_items.order_id', '=', 'orders.id')
                             ->where('order_items.status', 'confirmed')
                            ->where('users.code', $code);
                         
                       
                      
                         //select all orders from members
        $orders = User::join('orders', 'orders.user_id', '=', 'users.id')
                          ->leftjoin('order_items', 'order_items.order_id', '=', 'orders.id')
                        ->where('order_items.status', 'confirmed')
                         ->orwhere('order_items.status', 'paid')
                        ->orderBy('order_id', 'desc')
                        ->where('users.code', $code)// also see all orders of members
                         ->paginate( $request->get('per_page', 2));
                                              
                       //->get(['orders.*', 'users.*', 'order_items.*']);

        // count credit from members
        $credit = Voucher::join('users', 'users.id', '=', 'vouchers.user_id')
                        ->where('users.code', $code)
                       ->get('credit');


        // sum total order paid for by cooperative for his from members
        $sales = Transaction::join('users', 'users.id', '=', 'transactions.user_id')
                        ->where('users.code', $code)
                       ->get('tran_amount');
        return view('cooperative.cooperative', compact('members', 'orders', 'credit', 'count_orders', 'sales'));
    }
    else { return Redirect::to('/login');}
   
    }


    public function members(Request $request )
    {
    if( Auth::user()->role_name  == 'cooperative'){

        $code = Auth::user()->code; //
        // Product::paginate( $request->get('per_page', 4));
       
         //view all members aslo see credit of only his members
          $credit = Voucher::join('users', 'users.id', '=', 'vouchers.user_id')
                        ->where('users.code', $code)
                        ->paginate( $request->get('per_page', 10));
                       //->get(['vouchers.*', 'users.*']);
        // }
       return view('cooperative.all_members', compact('credit'));

       }
    else { return Redirect::to('/login');
    
        }
   
    }
    //

   
    public function invoice(Request $request, $order_id )
    {
     if( Auth::user()->role_name  == 'cooperative'){
         $code = Auth::user()->code; //
        $item = Order::join('users', 'users.id', '=', 'orders.user_id')// count orders from members
                          ->leftjoin('order_items', 'order_items.order_id', '=', 'orders.id')
                           ->join('shipping_details', 'shipping_details.shipping_id', '=', 'orders.id')
                             ->join('products', 'products.id', '=', 'order_items.product_id')
                              ->join('vouchers', 'vouchers.user_id', '=', 'users.id')
        
                        ->where('users.code', $code)// also see all orders of members
                        ->where('order_id', $order_id)
                        ->get(['vouchers.*', 'orders.*', 'users.*', 'order_items.*', 'shipping_details.*', 'products.*'])->first();

         $orders = Order::join('users', 'users.id', '=', 'orders.user_id')// count orders from members
                          ->leftjoin('order_items', 'order_items.order_id', '=', 'orders.id')
                           ->join('shipping_details', 'shipping_details.shipping_id', '=', 'orders.id')
                             ->join('products', 'products.id', '=', 'order_items.product_id')
                              ->join('vouchers', 'vouchers.user_id', '=', 'users.id')
                         // ->where('order_items.status', 'confirmed')
                         // ->orwhere('order_items.status', 'paid')
                        ->where('users.code', $code)// also see all orders of members
                        ->where('order_id', $order_id)
                        ->get(['orders.*', 'users.*', 'order_items.*', 'shipping_details.*', 'products.*', 'vouchers.*']);

 // if($request->has('download')){
 //         $pdf = PDF::loadView('invoice', compact('item', 'orders'));
     
 //        return $pdf->download('invoice.php');
 // }

    return view('invoice', compact('item', 'orders'));
           }

    else { return Redirect::to('/login');
    
        }
                     
    }






   
}// class
