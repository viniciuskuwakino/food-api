<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{

    public function __construct(
        private readonly ProductRepositoryInterface $repository
    ) {}

    public function listAll(): Collection
    {
        return $this->repository->listAll();
    }

    public function findById($contactId): Collection
    {
        return $this->repository->findById($contactId);
    }

    public function update($id, Array $req)
    {
        $product = $this->repository->findById($id);
        return $this->repository->update($product, $req);
    }
}
