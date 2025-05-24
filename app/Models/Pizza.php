<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    protected $fillable = ['name', 'price', 'description', 'category',   'status','image_url'];

    public function items(){
        return $this->hasMany(OrderItem::class);
    }
}
