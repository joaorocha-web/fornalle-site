<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    public function orders(){
        return $this->belongsTo(Order::class);
    }

    public function pizzas(){
        return $this->belongsTo(Pizza::class);
    }
}
