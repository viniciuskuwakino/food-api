<?php

namespace App\Repositories;

use App\Models\ProductFile;
use Illuminate\Database\Eloquent\Collection;

class ProductFileRepository implements ProductFileRepositoryInterface
{
    public function __construct(
        protected readonly ProductFile $model
    ){}

    public function listAll(): Collection
    {
        return $this->model->all();
    }

    public function findById(int $prodFileId): ProductFile | null
    {
        return $this->model::whereId($prodFileId)->first();
    }

    public function createFile(string $name): void
    {
        $this->model::create(['name' => $name]);
    }

    public function getNextFile(): ProductFile | null
    {
        return $this->model::where('opened', false)->first();
    }

    public function setFileOpened(ProductFile $prodFile): void
    {
        $prodFile['opened'] = true;
        $prodFile->save();
    }


}