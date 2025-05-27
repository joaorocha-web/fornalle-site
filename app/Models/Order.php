<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
    'customer_name',
    'customer_phone',
    'delivery_adress',
    'delivery_city',
    'delivery_neighborhood',
    'payment_method',
    'total',
    'user_id'
    // outros campos
];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function items(){
        return $this->hasMany(OrderItem::class);
    }

     public static function getBestClients()
    {
        
        return self::selectRaw('user_id, SUM(total) as total')
            ->with('users')
            ->whereHas('users') // Garante que só traz pizzas existentes
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->limit(2)
            ->get();
    }
    
}
