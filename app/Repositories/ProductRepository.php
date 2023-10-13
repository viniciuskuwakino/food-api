<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{

    public function __construct(
        protected readonly Product $model
    ){}

    public function listAll(): Collection
    {
        return $this->model->all();
    }

    public function findById(int $productId): Product | null
    {
        // return $this->model->find($productId)->get();
        return $this->model::whereId($productId)->first();
    }

    public function update(Product $product, $productId): Collection
    {
//        return $this->model->update();
        return $this->model->all();
    }

    // public function destroy(Product $product)
    // {
    //     dd($product->delete());
    // }

}
