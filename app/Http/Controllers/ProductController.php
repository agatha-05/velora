<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Ambil produk yang visible dan sertakan gambar dari variannya
        $products = Product::with('variants')->where('is_visible', true)->get();
        return view('home', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::with(['variants', 'category'])->where('slug', $slug)->firstOrFail();
        return view('product-detail', compact('product'));
    }
    public function search(Request $request)
    {
        $query = $request->input('q');

        // Mencari produk berdasarkan nama atau deskripsi yang mirip
        $products = \App\Models\Product::where('name', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%")
                    ->latest()
                    ->paginate(12);

        return view('search-results', compact('products', 'query'));
    }
}