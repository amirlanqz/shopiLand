<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {

        $hitsProducts = Product::query()
            ->orderBy('id', 'desc')
            ->where('is_hit', '=', 1)
            ->limit(4)
            ->get();
        $newProducts = Product::query()
            ->orderBy('id', 'desc')
            ->where('is_new', '=', 0)
            ->limit(8)
            ->get();
        return view('livewire.home-component', compact('hitsProducts', 'newProducts'));
    }
}
