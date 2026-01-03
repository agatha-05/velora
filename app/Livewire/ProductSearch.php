<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout; // Tambahkan ini
use App\Models\Product;

class ProductSearch extends Component
{
    public $search = '';

    #[Layout('layouts.master')] // Tambahkan atribut ini di atas fungsi render
    public function render()
    {
        $recommendations = [];
        
        if (strlen($this->search) >= 2) {
            $recommendations = Product::where('name', 'like', '%' . $this->search . '%')
                ->take(5)
                ->get();
        }

        return view('livewire.product-search', [
            'recommendations' => $recommendations
        ]);
    }
}