<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $service
    ) {}

    public function index(): AnonymousResourceCollection
    {
        return ProductResource::collection($this->service->listAll());
    }

    public function show(int $productId): JsonResponse
    {
        $product = $this->service->findById($productId);
        return response()->json($product);
    }

    public function update(ProductRequest $request, int $productId): JsonResponse
    {
        $product = $this->service->update($request, $productId);
        return response()->json($product);
    }

    public function destroy(int $productId): Response
    {
        $this->service->destroy($productId);
        return response()->noContent();
    }
}
