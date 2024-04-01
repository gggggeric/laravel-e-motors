<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_name',
        'amount',
        'product_type',
        'product_image',
        'quantity'
    ];

    /**
     * Get the orders associated with the product.
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'productID', 'id');
    }
}
