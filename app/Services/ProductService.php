<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Product;


class ProductService
{

    public function __construct(
        private readonly ProductRepositoryInterface $repository
    ) {}

    public function listAll(): Collection
    {
        return $this->repository->listAll();
    }

    public function findById(int $contactId): Product | null
    {
        return $this->repository->findById($contactId);
    }

    public function update($id, Array $req)
    {
        $product = $this->repository->findById($id);
        return $this->repository->update($product, $req);
    }

    public function destroy(int $productId)
    {
        $product = $this->repository->findById($productId);
        
        if ($product) {
            $product['status'] = 'trash';
            $product->save();
        }
    }
}
