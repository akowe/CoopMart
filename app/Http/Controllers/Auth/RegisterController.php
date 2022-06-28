<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Arr;

use App\Models\Voucher;
use Session;


 


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
          return Validator::make($data, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
          
            'role_name' => ['string'],
            'code' => ['string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $coop = \DB::table('users')->where('code',  $data['code'])->get('coopname');
         $get_coop = Arr::pluck($coop, 'coopname'); // 
           $coopname = implode(" ",$get_coop);

           $role = '4';
           $role_name = 'member';

            $user = User::create([
            'role' => $role,
            'role_name' => $role_name,
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'code' => $data['code'],
            'coopname'=> $coopname,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
          event(new Registered($user));
          // $rr = rand(1000000000,9999999999);
        $rand = $data['voucher'];

            $voucher = new Voucher();
            $voucher->user_id = $user->id;
            $voucher->voucher = $rand;
            $voucher->credit = '0';
            $voucher->save();
           
            Session::flash('status', ' You have successfully registered!. <br> Verification link has been sent to your email address. <br> Check your inbox or spam/junk'); 
            Session::flash('alert-class', 'alert-success'); 
          return $user;
        
         

    }
}
