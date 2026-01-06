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
        $product = Product::with(['category', 'variants'])->where('slug', $slug)->firstOrFail();

        // Ambil 4 produk terkait (kategori sama, tapi bukan produk ini sendiri)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        return view('product-detail', compact('product', 'relatedProducts'));
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