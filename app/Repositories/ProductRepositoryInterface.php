<?php

namespace App\Repositories;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function listAll();
    public function findById(int $productId);
    public function update(Product $product, $productId);
    // public function destroy(Product $product);
}
