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

    protected $casts = [
        'sent_at' => 'datetime',
        'received_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(CustomerOrder::class, 'order_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    // Accessor para obtener la URL completa de las imágenes
    public function getSentPhotoUrlAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

    public function getReceivedPhotoUrlAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }
}