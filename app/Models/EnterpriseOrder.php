<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnterpriseOrder extends Model
{
    use HasFactory;

    protected $table = 'enterprise_orders';

    protected $fillable = [
        'order_number', 
        'supplier_name', 
        'supplier_contact', 
        'order_date', 
        'delivery_address', 
        'notes', 
        'status', 
        'total_amount', 
        'is_deleted'
    ];

    protected $casts = [
        'status' => OrderStatus::class,
    ];

    public function changeStatus(OrderStatus $status): void
    {
        $this->update(['status' => $status]);
    }

    public function logicalDelete(): void
    {
        $this->update(['is_deleted' => true]);
    }

    public function restore(): void
    {
        $this->update(['is_deleted' => false]);
    }
}