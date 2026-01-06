<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Menampilkan halaman utama (Katalog)
     */
    public function index(Request $request)
    {
        // Ambil semua kategori untuk ditampilkan di tombol filter
        $categories = \App\Models\Category::all();

        // Query dasar produk
        $query = Product::with(['category', 'variants'])->where('is_visible', true);

        // Jika ada filter kategori di URL
        if ($request->has('category') && $request->category != '') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $products = $query->latest()->get();

        return view('home', compact('products', 'categories'));
    }

    /**
     * Menampilkan halaman detail produk
     */
    public function show($slug)
    {
        // 1. Cari produk berdasarkan slug
        // Eager loading variants dan category untuk performa yang lebih cepat
        $product = Product::with(['category', 'variants'])
            ->where('slug', $slug)
            ->firstOrFail();

        // 2. Ambil Produk Terkait (Related Products)
        // Logika: Ambil produk dengan kategori yang sama, tapi bukan produk itu sendiri
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id) // Agar produk yang sedang dilihat tidak muncul lagi
            ->with('category')
            ->latest()
            ->take(4) // Kita ambil 4 produk saja untuk tampilan grid
            ->get();

        // 3. Kirim kedua data ke view
        return view('product-detail', compact('product', 'relatedProducts'));
    }

    /**
     * Fitur Pencarian (Search)
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        $products = Product::where('is_visible', true)
            ->where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->with(['category', 'variants'])
            ->paginate(12); // Ganti get() menjadi paginate(12) agar ->total() berfungsi

        return view('search-results', compact('products', 'query'));
    }
}