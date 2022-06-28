<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Models\Voucher;
use Session;


class SellerController extends Controller
{
    //
     use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

     public function seller_insert(Request $request)
    {

        $this->validate($request, [
            'fname' => 'required', 'string', 'max:255',
            'lname' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:6', 'confirmed',
            'code' => 'string',
             'coopname' => 'string',
        ]);

           $role = '3';
           $role_name = 'merchant';

           //$user = new User;
            $user = User::create([
            'role' => $role,
            'role_name' =>$role_name,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'code' => $request->code,
            'coopname' => $request->coopname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
          event(new Registered($user));
          // $rr = rand(1000000000,9999999999);
        $rand = $request->voucher;

            $voucher = new Voucher();
            $voucher->user_id = $user->id;
            $voucher->voucher = $rand;
            $voucher->credit = '0';
            $voucher->save();
           
            Session::flash('status', ' You have successfully registered!. <br> Verification link has been sent to your email address. <br> Check your inbox or spam/junk'); 
            Session::flash('alert-class', 'alert-success'); 
          //return $user;

          return redirect('/')->with('status', ' You have successfully registered!. <br> Verification link has been sent to your email address. <br> Check your inbox or spam/junk');   
        
         

    }
}
