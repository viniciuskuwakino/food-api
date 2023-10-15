<?php

namespace App\Services;

use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Product;



class ProductService
{

    public function __construct(
        private readonly ProductRepositoryInterface $repository
    ) {}

    public function listAll(): LengthAwarePaginator
    {
        return $this->repository->listAll();
    }

    public function findById(int $productId): Product | null
    {
        return $this->repository->findById($productId);
    }

    public function update(ProductRequest $request, int $productId): Product | null
    {
        $product = $this->repository->findById($productId);

        if ($product) {
            return $this->repository->update($request, $product);
        } else {
            return null;
        }
    }

    public function destroy(int $productId): void
    {
        $product = $this->repository->findById($productId);
        if ($product) $this->repository->destroy($product);
    }
}
