<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Categories;
use App\Models\Product;
// use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

use Auth;
use Validator;
use Session;
use Storage;
use Mail;

class MerchantController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('merchant');
    }


    public function index(Request $request)
    {
   if( Auth::user()->role_name  == 'merchant'){

        // check if user has field his/her profile
        $user=Auth::user();
        $address = $user->address;
        $phone = $user->phone;
          if($address == '' && $phone =='')
          {
             Session::flash('profile', ' You are yet to update your profile! <br> Kindly navigate to profile page.'); 
                Session::flash('alert-class', 'alert-success'); 
          }
          
        $code = Auth::user()->code; //
    
         $id = Auth::user()->id; //
        // Product::paginate( $request->get('per_page', 4));
       
         //view all products by a merchant / seller
          $products = User::join('products', 'products.seller_id', '=', 'users.id')
                         ->where('products.prod_status', 'pending')
                         ->where('products.prod_status', 'approve')
                         ->orwhere('users.id', $id)

                        ->paginate( $request->get('per_page', 10));
                       //->get(['products.*', 'users.*']);
                        
                         // count products from members
        $count_product = User::join('products', 'products.seller_id', '=', 'users.id')
                          // ->where('products.prod_status', 'pending')
                         ->where('products.prod_status', 'approve')
                          ->where('users.id', $id);

                          //count number of order that has been paid
         $count_orders = Product::join('order_items', 'order_items.product_id', '=', 'products.id')
                          ->join('orders', 'orders.id', '=', 'order_items.order_id')
                          ->where('orders.status', 'Paid')
                           ->where('products.seller_id', $id);

          $sales = Product::join('order_items', 'order_items.product_id', '=', 'products.id')
                          ->join('orders', 'orders.id', '=', 'order_items.order_id')
                          ->where('orders.status', 'Paid')
                           ->where('products.seller_id', $id);  
             

       return view('merchants.merchant', compact('products', 'count_product', 'count_orders', 'sales'));

       }
    else { return Redirect::to('/login');
    
        }
    }
    
    //add new products
     public function product(Request $request)
    {
    if( Auth::user()->role_name  == 'merchant'){
        $categories = Categories::all(); 

        return view('merchants.add_new_product', compact('categories'));
        }
      else { return Redirect::to('/login');
        }
   
    
    }

      public function store(Request $request)
        {   

        $user_id = Auth::user()->id; // get the seller id

        // fields that are required 
        //|dimensions:max_width=600,max_height=600
         $this->validate($request, [
         'image' => 'required|image|mimes:jpg,png,jpeg|max:300',// maximum is 300kb , 600 x 600 pixel
         'img1' => 'image|mimes:jpg,png,jpeg|max:300',
         'img2' => 'image|mimes:jpg,png,jpeg|max:300',
         'img3' => 'image|mimes:jpg,png,jpeg|max:300',
         'img4' => 'image|mimes:jpg,png,jpeg|max:300',
         'prod_name' => 'required|string|max:100',
         'quantity' => 'required|string|max:100',
         'price' => 'required|string|max:100',
         'cat_id' => 'required|string|max:100',
        ]);
    
            //$image = $request->file('image')->getClientOriginalName();// get image original name
            
            //$image = time().'.'.$request->image->extension();
           
            //this works on local host and linux
           //$path = $request->file('image')->store('/images/resource', ['disk' =>   'my_files']);
           
            $image= $request->file('image');
            if(isset($image))
            {
            $imageName =  rand(1000000000, 9999999999).'.jpeg';
             $image->move(public_path('images'),$imageName);
             $image_path = "/images/" . $imageName; 

             }

            else {
            $image_path = "";
             }


           $img1= $request->file('img1');
            if(isset($img1))
            {
            $img1Name =  rand(1000000000, 9999999999).'.jpeg';
             $img1->move(public_path('images'),$img1Name);
             $img1_path = "/images/" . $img1Name; 

             }

            else {
            $img1_path = "";
             }


              $img2= $request->file('img2');
            if(isset($img2))
            {
            $img2Name = rand(1000000000, 9999999999).'.jpeg';
             $img2->move(public_path('images'),$img2Name);
             $img2_path = "/images/" . $img2Name; 

             }

            else {
            $img2_path = "";
             }



            $img3= $request->file('img3');
            if(isset($img3))
            {
            $img3Name =  rand(1000000000, 9999999999).'.jpeg';
             $img3->move(public_path('images'),$img3Name);
             $img3_path = "/images/" . $img3Name; 

             }

            else {
            $img3_path = "";
             }


            $img4= $request->file('img4');
            if(isset($img4))
            {
            $img4Name = rand(1000000000, 9999999999).'.jpeg';
             $img4->move(public_path('images'),$img4Name);
             $img4_path = "/images/" . $img4Name; 

             }

            else {
            $img4_path = "";
             }

              //    $img2= $request->file('img2');
           //  if(isset($img2))
           //  {
           //  $img2Name = time().'_'.$img2->getClientOriginalName();
           //   $img2->move(public_path('coopmart/images'),$img2Name);
           //   $img2_path = "/images/" . $img2Name; 

           //   }


            // add company and coperative percentage

            //$cop = $request->price * 5 / 100; //cooperative percentage

            $company_percentage = $request->price *  7 / 100;// coopmart percentage
        
            $price = $request->price  + $company_percentage;

           $product = new Product;
           $product->cat_id    = $request->cat_id;
           $product->prod_name  = $request->prod_name;
           $product->quantity   = $request->quantity;
           $product->prod_brand = $request->prod_brand;
           $product->old_price  = $request->old_price;
           $product->seller_price = $request->price;
           $product->price      = $price;
           $product->description= $request->description;
           $product->image      = $image_path;
           $product->img1       = $img1_path;
           $product->img2       = $img2_path;
           $product->img3       = $img3_path;
           $product->img4       = $img4_path;
           $product->seller_id  = $user_id;
           $product->prod_status = 'pending';
           $product->save();
         
           // send email notification to coopmart for approval
                   $data = array(
                    'name'      =>  'coopmart',
                    'message'   =>   'approve'
                );

             Mail::to('info@coopmart.ng')->send(new SendMail($data));

            
            return redirect('merchant')->with('status', 'New product added successfully');   
               
    }   
        // die();
    
  
  // this is a soft-delete. the product will not be visible on the platform for sale or for approve by Ad
    public function remove_product(Request $request)
    {

        $code = Auth::user()->code; //
         $seller_id = Auth::user()->id; //
    

        if(null !== $_POST['submit'])
        {
            $id  = $request->input('id');
             $input  = $request->input('prod_status');

             //update table
             Product::where('id', $id)
                    ->update([
                    'prod_status' => $input
                ]);

            Session::flash('remove', ' Product Removed Successful!'); 
            Session::flash('alert-class', 'alert-success'); 
          
           
        }

        return redirect()->back()->with('success', 'Product Removed Successful!');
    }


    public function sales_preview(Request $request)
    {
         if( Auth::user()->role_name  == 'merchant'){
               $id = Auth::user()->id; //

          $sales = Product::join('order_items', 'order_items.product_id', '=', 'products.id')
                           ->join('orders', 'orders.id', '=', 'order_items.order_id')
                          ->where('orders.status', 'Paid')
                           ->where('products.seller_id', $id) 
                           ->orderBy('date', 'desc')  
                            ->paginate( $request->get('per_page', 5));  

       return view('merchants.sales_preview', compact('sales'));

         }
         else{
            return Redirect::to('/login');
         } 
    }

}//class
