<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductFile;
use App\Repositories\ProductFileRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;

class ProductFileService
{
    public function __construct (
        private readonly ProductFileRepositoryInterface $repository
    ) {}

    public function listAll(): Collection
    {
        return $this->repository->listAll();
    }

    public function findById(int $prodFileId): ProductFile | null
    {
        return $this->repository->findById($prodFileId);
    }

    public function getNextFile(): ProductFile | null
    {
        return $this->repository->getNextFile();
    }

    public function addFileNames(string $names): void
    {
        $fileNames = trim($names);
        $fileNames = explode("\n", $fileNames);

        foreach ($fileNames as $file) {
            $this->repository->createFile($file);
        }
    }
}