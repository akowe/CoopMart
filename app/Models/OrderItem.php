<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
     protected $table = 'order_items';

    //   public function attributes()
    // {
    //     return $this->hasMany(products::class);
    // }
}
