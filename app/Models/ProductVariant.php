<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $casts = [
    'size' => 'array', // Memberitahu Laravel bahwa kolom ini menyimpan banyak data
];
    protected $fillable = [
        'product_id',
        'image',
        'color',
        'size',
        'price',
        'stock'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
}