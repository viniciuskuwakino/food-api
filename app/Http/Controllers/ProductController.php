<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $service
    ) {}

    public function index(): JsonResponse
    {
        return response()->json($this->service->listAll());
    }

    public function show(int $productId): JsonResponse
    {
        $product = $this->service->findById($productId);
        return response()->json($product);
    }

    public function update(int $productId): JsonResponse
    {
        $product = $this->service->findById($productId);
        return response()->json($product);
    }

    public function destroy(int $productId)
    {
        $this->service->destroy($productId);
        return response()->noContent();
    }
}
