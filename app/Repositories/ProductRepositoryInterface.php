<?php

namespace App\Repositories;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    public function listAll(): LengthAwarePaginator;
    public function findById(int $productId): Product | null;
    public function findByCode(string $productCode): Product | null;
    public function update(ProductRequest $request, Product $product): Product;
    public function destroy(Product $product): void;
    public function createProduct(array $product): void;
}
