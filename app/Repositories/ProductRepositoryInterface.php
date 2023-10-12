<?php

namespace App\Repositories;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function listAll();
    public function findById($productId);
    public function update(Product $product, $productId);
    public function delete($productId);
}
