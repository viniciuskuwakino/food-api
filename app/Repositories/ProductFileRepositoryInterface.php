<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductFile;
use Illuminate\Database\Eloquent\Collection;

interface ProductFileRepositoryInterface
{
    public function listAll(): Collection;
    public function findById(int $prodFileId): ProductFile | null;
//    public function update(Product $product, $productId);
    public function createFile(string $name): void;
    public function getNextFile(): ProductFile | null;
    public function setFileOpened(ProductFile $prodFile): void;

}