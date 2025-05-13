<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Importar el trait
use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    use HasFactory; // Usar el trait

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

    // Relación con las evidencias de entrega
    public function evidencePicture()
    {
        return $this->hasOne(EvidencePicture::class, 'order_id');
    }

    // Método helper para verificar si tiene evidencias
    public function hasDeliveryEvidence()
    {
        return $this->evidencePicture()->exists();
    }

    // Método helper para verificar si la entrega está confirmada
    public function isDeliveryConfirmed()
    {
        return $this->evidencePicture && $this->evidencePicture->received_photo_url !== null;
    }

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

    // Relación con Customer (opcional, pero recomendable si tienes un modelo Customer)
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_number', 'customerNumber');
    }

    // Relación con OrderProduct (opcional, pero recomendable)
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }

    // Nuevo método para calcular y actualizar el total
    public function updateTotalAmount()
    {
        $total = $this->orderProducts()->sum('total_price');
        $this->update(['total_amount' => $total]);
    }

    // Nuevo método para verificar si la orden está completada
    public function isCompleted()
    {
        return $this->status === 'DELIVERED';
    }

    // Nuevo método para verificar si se pueden agregar productos
    public function canAddProducts()
    {
        return !in_array($this->status, ['DELIVERED', 'IN_ROUTE']);
    }
}
