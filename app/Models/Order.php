<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
        use HasFactory;
    
        protected $fillable = [
            'productID',
            'userID',
            'orderStatus',
            'quantity',
            'total',
        ];
    
        /**
         * Get the product associated with the order.
         */
        public function product()
        {
            return $this->belongsTo(Product::class, 'productID', 'id');
        }
    
        /**
         * Calculate the total based on the quantity and amount.
         */
        public function calculateTotal()
        {
            // Ensure the product relationship is loaded
            $this->load('product');
    
            // Calculate total based on quantity and amount
            if ($this->product) {
                return $this->quantity * $this->product->amount;
            }
    
            return 0; // Default to 0 if product is not found
        }
}
