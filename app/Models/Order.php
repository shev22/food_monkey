<?php

namespace App\Models;

use App\Models\OrderItems;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable =[

        'user_id',
        'fname',
        'lname',
        'email',
        'phone',
        'address',
        'status',
        'message',
        'payment_mode',
        'payment_id',
        'total_price',
        'tracking_no',
    ];

    public function orderitems()
    {
        return $this->hasMany(OrderItems::class);
    }



}
