<?php

namespace App\Helpers\Traits;

trait CartTrait
{

    public int $quantity = 1;
    public function addToCart(int $productId, $quantity = false)
    {
        dump($productId);
    }

}
