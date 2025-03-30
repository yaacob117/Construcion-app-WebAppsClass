<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'is_admin',
        'is_sales',
        'is_purchasing',
        'is_warehouse',
        'is_route',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
