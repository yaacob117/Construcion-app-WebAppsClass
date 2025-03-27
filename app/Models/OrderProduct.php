<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $table = 'order_products';
    protected $fillable = ['order_id', 'product_id', 'quantity', 'unit_price', 'total_price'];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function customer_orders()
    {
        return $this->belongsTo(CustomerOrder::class, 'order_id');
    }
}
