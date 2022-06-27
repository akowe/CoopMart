<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;

use App\Models\User;
use App\Models\Voucher;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingDetail;
use App\Models\Transaction;
use App\Mail\PaymentEmail;
use App\Mail\ConfirmPaymentEmail;
use App\Mail\SalesEmail;


use Auth;
use Validator;
use Session;
use Paystack;
use Mail;


class PaymentController extends Controller
{
    //
/**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */

 public function redirectToGateway()
    {
        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }        
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        //callback_url = http://localhost:8000/payment/callback/
        $paymentDetails = Paystack::getPaymentData();

        //$payment = json_decode(json_encode($paymentDetails),true);
        //dd($paymentDetails); // display all payment details

       //get individual payment data from to store in DB
        $status = Arr::pluck($paymentDetails, 'status');// get the status of the payment
        $get_status = implode(" ",$status);

        $reference = Arr::pluck($paymentDetails, 'reference');// paystack reference
        $get_ref = implode(" ",$reference);

        $amount = Arr::pluck($paymentDetails, 'amount'); 
        $get_amount = implode(" ",$amount) / 100;

        $created_at = Arr::pluck($paymentDetails, 'created_at');//
        $get_createDate = implode(" ",$created_at);

        $paid_at = Arr::pluck($paymentDetails, 'paid_at');//
        $get_paidDate = implode(" ",$paid_at);

        //get data from multidimemntion array in the payment data

        //echo implode(" ",$mm);// convert array to string
         $metaData = array_column($paymentDetails, 'metadata');
                 
         $member = Arr::pluck($metaData, 'member_id'); // id of the member that place the order
         $member_id = implode(" ",$member);

         $user = Arr::pluck($metaData, 'user_id'); //id of the cooperative that make the payment
         $user_id = implode(" ",$user);

         $order = Arr::pluck($metaData, 'order_id'); // id of the particular order
         $order_id = json_encode($order, true);
      

         $authorization = array_column($paymentDetails, 'authorization');  

         $authorization_code = Arr::pluck($authorization, 'authorization_code'); // 
         $get_authCode = implode(" ",$authorization_code);

         //print_r($get_amount);
        // if($get_status = 'success'){

        //    // insert to transaction table
        //      $orderItem = new Transaction();
        //      $orderItem->member_id          = $member_id;
        //      $orderItem->user_id            = $user_id;
        //      $orderItem->order_id           = $order_id;
        //      $orderItem->authorization_code = $get_authCode;
        //      $orderItem->paystack_ref       = $get_ref;
        //      $orderItem->tran_amount        =  $get_amount;
        //      $orderItem->pay_status         =  $get_status;
        //      $orderItem->save();
            
        // }

 if($get_status = 'success'){

           // insert to transaction table
             $orderItem = new Transaction();
           
             $orderItem->user_id            = $user_id;
           
             $orderItem->authorization_code = $get_authCode;
             $orderItem->paystack_ref       = $get_ref;
             $orderItem->tran_amount        =  $get_amount;
             $orderItem->pay_status         =  $get_status;
             $orderItem->save();
            
        }

        if($orderItem){

        //update order status to Paid in orderItem table with new credit balance
            Order::where('status', 'confirmed' )
                    ->update([
                    'status' => 'Paid',
                    'pay_status'=>'success',
                    'pay_type'=>'Paystack'
                ]);

// reduce product qunatity if paymemt is successful
                $newOrders = \DB::table('order_items')->get();
                    
                    foreach ($newOrders as $order){
                     $stock = \DB::table('products')->where('id', $order->product_id)->first()->quantity;
                     
                         if($stock > $order->order_quantity){
                             \DB::table('products')->where('id', $order->product_id)->decrement('quantity',$order->order_quantity);
                            }

                 //get  seller details to send email notification
                 
                 // $seller = User::join  ('products', 'products.seller_id', '=', 'users.id') 
                 //            ->leftjoin('order_items', 'order_items.product_id', '=', $order->product_id)

                 //            ->get('users.email');    


                 //           $seller2 = Product::join('order_items', 'order_items.product_id', '=', $order->product_id) 
                 //            ->leftjoin('users', 'users.id', '=', )

                 //            ->get('users.email');          

                              

                        }//reduce product qty


    
    //get details of coperative
$user_details = \DB::table('users')->where('id', $user_id)->get('*');
// get name of the coop that make payment         
$name = Arr::pluck($user_details, 'coopname');
        $get_name = implode(" ",$name);

$email = Arr::pluck($user_details, 'email');
        $get_email = implode(" ",$email);

$phone = Arr::pluck($user_details, 'phone');
        $get_phone = implode(" ",$phone);


$order_details = \DB::table('order_items')->where('order_id', $order_id)->get('*');

$order_number = Arr::pluck($order_details, 'order_number');
        $get_order_number = implode(" ",$order_number);

$order_quantity = Arr::pluck($order_details, 'order_quantity');
        $get_order_quantity = implode(" ",$order_quantity);



$product_details = \DB::table('products')->where('id', $order->product_id)->get('*');

$prod_name = Arr::pluck($product_details, 'prod_name');
        $get_prod_name = implode(" ",$prod_name);


$seller_id = Arr::pluck($product_details, 'seller_id');
        $get_seller_id = implode(" ",$seller_id);


// get the seller/ merchant info.
$seller_details = \DB::table('users')->where('id', $get_seller_id)->get('*'); 

$seller_fname = Arr::pluck($seller_details, 'fname');
        $get_seller_fname = implode(" ",$seller_fname);

 $seller_lname = Arr::pluck($seller_details, 'lname');
        $get_seller_lname = implode(" ",$seller_lname);

 $seller_email = Arr::pluck($seller_details, 'email');
        $get_seller_email = implode(" ",$seller_email);

 $seller_phone = Arr::pluck($seller_details, 'phone');
        $get_seller_phone = implode(" ",$seller_phone);              
       

//dd($get_prod_name);


                }//orderitem

         Session::flash('payment', ' Your payment was successfull!'); 
            Session::flash('alert-class', 'alert-success'); 


            // send email notification to admin
                   $data = array(
                    'name'          =>  $get_name,
                    'order_number'   =>  $get_order_number,  
                     'amount'       =>  $get_amount,  
                     'product'      =>  $get_prod_name 
                    
                );

             Mail::to('estherakowe@yahoo.com')->send(new PaymentEmail($data));

             //send  payment confirmation email to the cooperative

             Mail::to($get_email)->send(new ConfirmPaymentEmail($data));


             //send  sales email to seller

            // Mail::to($seller)->send(new SalesEmail($data));
       
        return redirect()->route('cooperative');

       
      
    }


}//class
