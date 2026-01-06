<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 
        'name', 
        'slug', 
        'description', 
        'image', 
        'price', 
        'stock', 
        'is_visible', 
        'is_featured'
    ];

    /**
     * Menggunakan slug sebagai kunci pencarian di URL secara otomatis
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Relasi ke Kategori
     */
    public function category() 
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke Varian Produk
     */
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    /**
     * Mendapatkan URL gambar utama dari varian pertama
     */
    public function getThumbnailUrl()
    {
        // Menggunakan relation property (bukan method) agar bisa memanfaatkan Eager Loading
        $firstVariant = $this->variants->first();
        
        if ($firstVariant && $firstVariant->image) {
            return Storage::url($firstVariant->image);
        }

        // Jika tidak ada gambar, kembalikan gambar placeholder agar website tidak pecah
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

    /**
     * Scope untuk mengambil produk yang tampil saja (digunakan di Controller)
     */
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    /**
     * Scope untuk mengambil produk unggulan
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}