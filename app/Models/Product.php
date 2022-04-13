<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // mendefinisikan tabel products
    protected $table = 'product';

    // mempersilahkan inputan mana saja yang bisa di input user
    protected $fillable = ['product_name',  'product_type', 'product_price', 'expired_at'];
}
