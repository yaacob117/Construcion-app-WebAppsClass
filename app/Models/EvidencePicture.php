<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvidencePicture extends Model
{
    use HasFactory;

    protected $table = 'evidence_pictures'; 
    protected $fillable = [
        'order_id',
        'sent_photo_url',
        'received_photo_url',
        'sent_at',
        'received_at',
        'uploaded_by',
    ];

    
    public function order()
    {
        return $this->belongsTo(CustomerOrder::class, 'order_id');
    }
}