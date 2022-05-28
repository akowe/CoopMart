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
use Illuminate\Support\Carbon;

use Auth;
use Validator;
use Session;


class MembersController extends Controller
{
       public function __construct()
    {
          $this->middleware(['auth', 'verified']);
            $this->middleware('members');
           
    }

public function index(Request $request)
{
     if( Auth::user()->role_name  == 'member'){
        $id = Auth::user()->id; 
                    // sumt credit from a member
        $credit = Voucher::join('users', 'users.id', '=', 'vouchers.user_id')
                       ->where('users.id', $id)
                       ->get('credit');

                        // count orders from a member
        $count_orders = User::join('orders', 'orders.user_id', '=', 'users.id')
                        ->leftjoin('order_items', 'order_items.order_id', '=', 'orders.id')
                          ->orwhere('order_items.status', 'confirmed')
                           ->where('users.id', $id);
                      
                         //select all order history of a member
        $orders = User::join('orders', 'orders.user_id', '=', 'users.id')
                          ->leftjoin('order_items', 'order_items.order_id', '=', 'orders.id')
                        
                         ->where('order_items.status', 'confirmed')
                         ->orwhere('order_items.status', 'paid')
                        ->orderBy('order_id', 'desc')
                        ->where('users.id', $id)// also see all orders of a member
                         ->paginate( $request->get('per_page', 5));

    return view('members.dashboard', compact('credit', 'count_orders', 'orders'));
    }
     else { return Redirect::to('/login');
    
    }
}

    public function member_invoice(Request $request, $order_id )
    {
     if( Auth::user()->role_name  == 'member'){
         $id = Auth::user()->id; //
        $item = Order::join('users', 'users.id', '=', 'orders.user_id')// count orders from members
                          ->leftjoin('order_items', 'order_items.order_id', '=', 'orders.id')
                           ->join('shipping_details', 'shipping_details.shipping_id', '=', 'orders.id')
                             ->join('products', 'products.id', '=', 'order_items.product_id')
                              ->join('vouchers', 'vouchers.user_id', '=', 'users.id')
        
                        ->where('users.id', $id)// also see all orders of members
                        ->where('order_id', $order_id)
                        ->get(['vouchers.*', 'orders.*', 'users.*', 'order_items.*', 'shipping_details.*', 'products.*'])->first();

         $orders = Order::join('users', 'users.id', '=', 'orders.user_id')// count orders from members
                          ->leftjoin('order_items', 'order_items.order_id', '=', 'orders.id')
                           ->join('shipping_details', 'shipping_details.shipping_id', '=', 'orders.id')
                           ->join('products', 'products.id', '=', 'order_items.product_id')
                           ->join('vouchers', 'vouchers.user_id', '=', 'users.id')
                           // ->where('order_items.status', 'confirmed')
                           // ->orwhere('order_items.status', 'paid')

                          ->where('users.id', $id)// also see all orders of members
                          ->where('order_id', $order_id)
                          ->get(['orders.*', 'users.*', 'order_items.*', 'shipping_details.*', 'products.*', 'vouchers.*']);

    return view('invoice', compact('item', 'orders'));
           }

    else { return Redirect::to('/login');
    
        }
    }
   

     // cancel order where status is confirmed
    public function cancel_order(Request $request)
    {
         $id = Auth::user()->id; //
    
        if(null !== $_POST['submit'])
        {
            $order_id  = $request->input('order_id');
             $input  = $request->input('status');

             //update table
             OrderItem::where('order_id', $order_id)
                    ->update([
                    'status' => $input
                ]);

            // refund credit, charge #200
            $amount  = $request->input('amount');

            $bal = $amount - 200;
            DB::table('vouchers')->where('user_id', $id)->increment('credit',$bal);

            Session::flash('status', ' Your order has been canceled  successful!'); 
            Session::flash('alert-class', 'alert-success'); 
        }

        return redirect()->back()->with('success', 'Your order has been canceled successful!');
    } 
}//class