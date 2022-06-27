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
use App\Models\About;
use App\Models\Privacy;
use App\Models\ReturnRefund;
use App\Models\Terms;


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
                          ->where('orders.status', 'confirmed');
                      
                         //select all orders from members
          $orders = User::join('orders', 'orders.user_id', '=', 'users.id')
                        ->where('orders.status', 'confirmed')
                         ->orwhere('orders.status', 'paid')
                        ->orderBy('date', 'desc')
                         ->paginate( $request->get('per_page', 5));                   
                       //->get(['orders.*', 'users.*', 'order_items.*']);

        // count credit from members
        // $credit = Voucher::join('users', 'users.id', '=', 'vouchers.user_id')
        //                ->get('credit');

        // sum total order paid for by cooperative for his from members
        $transaction = Transaction::join('users', 'users.id', '=', 'transactions.user_id')
                       ->get('tran_amount');

      $sales = Product::join('order_items', 'order_items.product_id', '=', 'products.id')
                           ->leftjoin('users', 'users.id', '=', 'products.seller_id') 
                           ->leftjoin('orders', 'orders.user_id', '=', 'users.id')  
                          ->where('orders.status', 'Paid')
                          ->paginate( $request->get('per_page', 5));  

        $products = Product::all();

        return view('company.admin', compact('cooperatives', 'sellers', 'members', 'count_orders', 'orders', 'sales', 'products', 'users', 'transaction'));
    }
    else { return Redirect::to('/login');}
   
    }
 

    public function sales_invoice(Request $request, $order_number )
    {
     if( Auth::user()->role_name  == 'superadmin'){
    
        $item = Order::join('users', 'users.id', '=', 'orders.user_id')// count orders from members
                          ->leftjoin('order_items', 'order_items.order_id', '=', 'orders.id')
                           ->join('shipping_details', 'shipping_details.shipping_id', '=', 'orders.id')
                             ->join('products', 'products.id', '=', 'order_items.product_id')
                              ->join('vouchers', 'vouchers.user_id', '=', 'users.id')
        
                        ->where('order_number', $order_number)
                        ->get(['vouchers.*', 'orders.*', 'users.*', 'order_items.*', 'shipping_details.*', 'products.*'])->first();

         $orders = Order::join('users', 'users.id', '=', 'orders.user_id')// count orders from members
                          ->leftjoin('order_items', 'order_items.order_id', '=', 'orders.id')
                           ->join('shipping_details', 'shipping_details.shipping_id', '=', 'orders.id')
                             ->join('products', 'products.id', '=', 'order_items.product_id')
                              ->join('vouchers', 'vouchers.user_id', '=', 'users.id')
                         // ->where('order_items.status', 'confirmed')
                         // ->orwhere('order_items.status', 'paid')
                        ->where('order_number', $order_number)
                        ->get(['orders.*', 'users.*', 'order_items.*', 'shipping_details.*', 'products.*', 'vouchers.*']);

    return view('invoice', compact('item', 'orders'));
           }

    else { return Redirect::to('/login');
    
        }             
    }




 public function order_details(Request $request, $order_number )
    {
     if( Auth::user()->role_name  == 'superadmin'){
    
         $orders = Product::join('users', 'users.id', '=', 'products.seller_id')
                          ->join('order_items', 'order_items.product_id', '=', 'products.id')
                          ->join('orders', 'orders.id', '=', 'order_items.order_id')
                          ->where('orders.status', 'paid')
                        ->orwhere('orders.order_number', $order_number)
                         ->orderBy('date', 'desc')
                        // ->get(['orders.*', 'users.*', 'order_items.*', 'products.*']);
                          ->paginate( $request->get('per_page', 5)); 

    return view('company.order_details', compact('orders'));
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


//offline payment
    public function mark_paid(Request $request)
    {

        if(null !== $_POST['submit'])
        {
            $order_number  = $request->input('order_number');
             //$input  = $request->input('p');

             //mark order as paid
            \DB::table('orders')
                ->where('order_number', $order_number)
                ->update([
                    'status' => 'Paid',
                    'pay_status'=>'success',
                    'pay_type'=>'Offline'

                ]);

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

    else { return Redirect::to('/login');
    }
   
    }


 public function about(Request $request){
  
      if( Auth::user()->role_name  == 'superadmin'){
        $about = About::all();
        return view('company.add_about', compact('about'));
      }

    else { return Redirect::to('/login');
    }
  }

  //edit 
 public function about_edit(Request $request, $id){
        if( Auth::user()->role  == '1'){
            $about = About::find($id);
            return view('company.about_edit', compact('about')); 
         }
          else { return Redirect::to('/login');
    }
    }

    //update 
public function about_update(Request $request, $id)
    {
        $about = About::find($id);
        $about->about = $request->input('about');
        $about->our_story = $request->input('our_story');
        $about->update();
        return redirect()->back()->with('status','About page updated');
    }

public function privacy(Request $request){
  
      if( Auth::user()->role_name  == 'superadmin'){
        $about = Privacy::all();
        return view('company.add_privacy_policy', compact('about'));
      }

    else { return Redirect::to('/login');
    }
  }

  //edit 
 public function privacy_edit(Request $request, $id){
        if( Auth::user()->role  == '1'){
            $about = Privacy::find($id);
            return view('company.privacy_edit', compact('about')); 
         }
          else { return Redirect::to('/login');
    }
    }

    //update 
    public function privacy_update(Request $request, $id)
    {
        $about = Privacy::find($id);
        $about->privacy_policy = $request->input('privacy');
        $about->update();
        return redirect()->back()->with('status','Privacy page updated');
    }


    public function refund(Request $request){
  
      if( Auth::user()->role_name  == 'superadmin'){
        $about = ReturnRefund::all();
        return view('company.add_refund_and_return_policy', compact('about'));
      }

    else { return Redirect::to('/login');
    }
  }

  //edit 
 public function refund_edit(Request $request, $id){
        if( Auth::user()->role  == '1'){
            $about = ReturnRefund::find($id);
            return view('company.refund_edit', compact('about')); 
         }
          else { return Redirect::to('/login');
    }
    }

    //update 
    public function refund_update(Request $request, $id)
    {
        $about = ReturnRefund::find($id);
        $about->return_policy = $request->input('return');
        $about->update();
        return redirect()->back()->with('status','Reurn & Refund page updated');
    }


public function tandc(Request $request){
  
      if( Auth::user()->role_name  == 'superadmin'){
        $about = Terms::all();
        return view('company.add_terms_and_condition', compact('about'));
      }

    else { return Redirect::to('/login');
    }
  }

  //edit 
 public function tandc_edit(Request $request, $id){
        if( Auth::user()->role  == '1'){
            $about = Terms::find($id);
            return view('company.terms_edit', compact('about')); 
         }
          else { return Redirect::to('/login');
    }
    }

    //update 
    public function tandc_update(Request $request, $id)
    {
        $about = Terms::find($id);
        $about->terms_c = $request->input('terms_c');
        $about->update();
        return redirect()->back()->with('status','T & C page updated');
    }


     public function removed_product(Request $request){
  
      if( Auth::user()->role_name  == 'superadmin'){
        $products = User::join('products', 'products.seller_id', '=', 'users.id')
                         ->where('products.prod_status', 'remove')
                        ->paginate( $request->get('per_page', 4));
        return view('company.removed_product', compact('products'));
      }

    else { return Redirect::to('/login');
    }
  }

}//class
