<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PickupLaundry extends Model
{
    protected $fillable = [
        'order_id',
        'customer_id',
        'pickup_date',
        'notes',
    ];

    public function order()
    {
        return $this->belongsTo(TransOrder::class, 'order_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
