<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransOrder extends Model
{
    protected $fillable = [
        'customer_id',
        'customer_name',
        'customer_phone',
        'customer_address',
        'voucher_code',
        'discount_percent',
        'discount_nominal',
        'order_code',
        'order_date', 
        'order_end_date', 
        'order_status', 
        'order_pay', 
        'order_change', 
        'tax', 
        'total'
    ];
    
    public function customer()
{
    return $this->belongsTo(Customer::class, 'customer_id');
}

public function details()
{
    return $this->hasMany(TransOrderDetail::class, 'order_id');
}
}
