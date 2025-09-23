<?php

namespace App\Helpers\Cart;

use App\Models\Product;
use function Laravel\Prompts\select;

class Cart
{

    public static function addToCart(int $productId, int $quantity = 1): bool
    {
        $added = false;
        if (self::hasProductInCart($productId)) {
            session(["cart.{$productId}.quantity" => session("cart.{$productId}.quantity") + $quantity]);
            $added = true;
        } else {
            $product = Product::query()->find($productId);
            if ($product) {
                $newProduct = [
                    'title' => $product->title,
                    'slug' => $product->slug,
                    'image' => $product->image,
                    'price' => $product->price,
                    'quantity' => $quantity,
                ];
                session(["cart.{$productId}" => $newProduct]);
                $added = true;
            }
        }

        return $added;

    }

    public static function hasProductInCart(int $productId): bool
    {
        return session()->has("cart.$productId");
    }

    public static function getCart(): array
    {
        return session('cart') ?: [];
    }


}
