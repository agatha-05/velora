<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'slug', 'description', 'image', 'price', 'stock', 'is_visible', 'is_featured'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
    public function getThumbnailUrl()
    {
        // Ambil gambar dari varian pertama
        $firstVariant = $this->variants()->first();
        
        if ($firstVariant && $firstVariant->image) {
            return Storage::url($firstVariant->image);
        }

        return asset('images/placeholder.jpg'); // Pastikan ada gambar default
    }
}
