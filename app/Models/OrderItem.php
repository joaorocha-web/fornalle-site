<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'pizza_id',
        'quantity',
        'unit_price',
    ];

    public function orders(){
        return $this->belongsTo(Order::class);
    }

    public function pizza(){
        return $this->belongsTo(Pizza::class);
    }

    // OrderItem.php
    public static function getBestSellers()
    {
        
        return self::selectRaw('pizza_id, SUM(quantity) as total')
            ->with('pizza')
            ->whereHas('pizza') // Garante que só traz pizzas existentes
            ->groupBy('pizza_id')
            ->orderByDesc('total')
            ->limit(10)
            ->get();
    }
    
}
