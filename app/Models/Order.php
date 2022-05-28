<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    // protected $guarded = [];
    

    // protected $fillable =[

    //     'user_id', 'voucher_id', 'prod_name', 'order_qty', 'ship_address', 'ship_city', 'ship_phone', 
    //     'note', 'status'
    // ];


}//class
