<?php

namespace App\Helpers\Traits;

use App\Helpers\Cart\Cart;

trait CartTrait
{

    public int $quantity = 1;
    public function addToCart(int $productId, $quantity = false)
    {
        $quantity = $quantity ? $this->quantity : 1;
        if ($quantity < 1) {
            $quantity = 1;
        }

        if (Cart::addToCart($productId, $quantity)) {
            $this->js("toastr.success('Product added to cart successfully!')");
            $this->dispatch('cart-updated');
        } else {
            $this->js("toastr.error('Product added to cart unsuccessfully!')");
        }
    }

}
