<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    protected $fillable = [
        'invoice_number',
        'customer_number',
        'customer_name',
        'fiscal_data',
        'order_date',
        'delivery_address',
        'notes',
        'status',
        'total_amount',
        'is_deleted',
    ];

    public function changeStatus(string $status)
    {
        $this->status = $status;
        $this->save();
    }

    public function logicalDelete()
    {
        $this->is_deleted = true;
        $this->save();
    }

    public function restore()
    {
        $this->is_deleted = false;
        $this->save();
    }
}
