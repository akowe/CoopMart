<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use App\Models\Product;
use App\Models\Categories;
use App\Models\Voucher;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingDetail;
use App\Mail\ConfirmOrderEmail;



use App\Models\User;
use Session;
use Validator;
use Auth;
use Mail;

class OrderController extends Controller
{
    //
      public function __construct()
    {
         $this->middleware('auth');
       
    }


    public function confirm_order(){
        return view('order');
        }


    public function order(Request $request){
        $member= Auth::user()->id;
        
         //get cart items

         $cart = session()->get('cart');

         //get others form input
        $order_number  = $_POST['order_number'];
        $order_status  = $_POST['status'];
        $ship_address  = $_POST['ship_address'];
        $ship_city     = $_POST['ship_city'];
        $ship_phone    = $_POST['ship_phone'];
        $note          = $_POST['note'];


       if(isset($_POST) && count($_POST) > 0) {

         $totalAmount = 0;

        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];

            // check if sufficient credit limit
             $getcredit = \DB::table('vouchers')->where('user_id', $member)->first()->credit;
           if($getcredit < $totalAmount){

            return redirect()->route('cart')->with('success', ' You Have Insufficient Credit Limit . Contact Your Cooperative');
           }

        }
         

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->total = $totalAmount;
        $order->save();

         $data = [];

        foreach ($cart as $item) {
            $data['items'] = [
                [
                    'prod_name' => $item['prod_name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    
            ]
        ];

        $orderItem = new OrderItem();
             $orderItem->order_id   = $order->id;
             $orderItem->product_id = $item['id'];
             $orderItem->order_quantity   = $item['quantity'];
             $orderItem->amount     = $item['price'];
             $orderItem->order_number = $order_number;
             $orderItem->status     = $order_status;
             $orderItem->save();
        }

           $shipDetails = new ShippingDetail();
            $shipDetails->shipping_id = $orderItem->order_id;
            $shipDetails->ship_address = $ship_address;
            $shipDetails->ship_city = $ship_city;
            $shipDetails->ship_phone = $ship_phone;
            $shipDetails->note = $note;
            $shipDetails->save();

       
        if($orderItem){

        //update voucher table with new credit balance
            Voucher::where('user_id', $member)
                    ->update([
                    'credit' => $request->input('bal')
                ]);

      
            //for every new order decrease product quantity
            //  $newOrders = \DB::table('order_items')->get();
            
            // foreach ($newOrders as $order){
            //  $stock = \DB::table('products')->where('id', $order->product_id)->first()->quantity;
             
            //      if($stock > $order->order_quantity){
            //          \DB::table('products')->where('id', $order->product_id)->decrement('quantity',$order->order_quantity);
            //         }
            // }

         // $prod_name  = \DB::table('products')->where('id', $order->product_id)->get('prod_name');   
         
               
        }
       
        //remove item from cart
       
        $request->session()->forget('cart');

           $name =  \DB::table('users')->where('id', $order->user_id)->get('fname') ; 
           $username = Arr::pluck($name, 'fname'); // 
           $get_name = implode(" ",$username);

            $email =  \DB::table('users')->where('id', $order->user_id)->get('email') ; 
           $useremail = Arr::pluck($email, 'email'); // 
           $get_email = implode(" ",$useremail);


           
         // send email notification to admin
            $data = array(
            'name'         => $get_name,
            'order_number' => $order_number,  
            'amount'       => $totalAmount,       
                );

             Mail::to($get_email)->send(new ConfirmOrderEmail($data));   
            

    return redirect()->route('cart')->with('success', 'Your Order was successfull');
      
  }//isset  
}//function



 public function invoice(Request $request )
    {

    }

}//class
