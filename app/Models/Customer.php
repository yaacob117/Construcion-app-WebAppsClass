<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'customerNumber',
        'name',
        'companyName',
        'fiscalData',
        'address',
    ];

    public function customerOrders()
    {
        return $this->hasMany(CustomerOrder::class, 'customer_number', 'customerNumber');
    }
}
