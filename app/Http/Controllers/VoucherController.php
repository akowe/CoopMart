<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Voucher;
use App\Models\Order;
use Auth;
use Validator;
use Session;

class VoucherController extends Controller
{
    //
       public function __construct()
    {
         $this->middleware('auth');
           // $this->middleware('cooperative');
           // $this->middleware('superadmin');
       
    }

    public function credit_limit(Request $request)
{

        $code = Auth::user()->code; //
    

        if(null !== $_POST['submit'])
        {
            $user_id  = $request->input('user_id');
             $input  = $request->input('credit');

              // check if user is verified
             $verified = \DB::table('users')->where('id', $user_id)->first()->email_verified_at;
           if($verified){

             //increase member credit limit
            \DB::table('vouchers')->where('user_id', $user_id)->increment('credit',$input);
            Session::flash('credit', ' Credit Added!'); 
            Session::flash('alert-class', 'alert-success'); 
           }

            else{
                  Session::flash('verified', 'Credit not added. This member has not verified his/her account.'); 
            Session::flash('alert-class', 'alert-danger'); 
            }
           
        }

        

            //return view('cooperative.credit_limit', compact('credit'));
             return redirect()->back();

}


   public function limit()
{
     return view('cooperative.credit_limit');
    }

}//class


