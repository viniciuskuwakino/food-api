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

    public function findByCode(string $productCode): Product | null
    {
        return $this->repository->findByCode($productCode);
    }

    public function update(ProductRequest $request, string $productCode): Product | null
    {
        $product = $this->repository->findByCode($productCode);

        if ($product) {
            return $this->repository->update($request, $product);
        } else {
            return null;
        }
    }

    public function destroy(string $productCode): void
    {
        $product = $this->repository->findByCode($productCode);
        if ($product) $this->repository->destroy($product);
    }
}
